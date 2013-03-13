<?php

class Account_Controller extends Base_Controller {
		
	public function __construct()
	{
		// user must be logged in
		
	}

	public function action_index()
	{
		return Redirect::to('/account/profile');
	}
	
	// @TODO fix file upload
	public function action_profile()
	{
		$user = User::find(Auth::user()->id);
		// get input data
		$inputs = Input::all();
		// define the validation rules
		$rules = array(
			'display_name'	=> 'required',
			'email'			=> 'required|email|unique:users,email,'. Auth::user()->id,
			'phone'			=> 'integer',
			'picture' 		=> 'image|max:500'
		);
		// validate the data
		$validation = Validator::make($inputs, $rules);
		// check whether to display the form or not
		if($validation->fails()) {
			// build view
			$template = array(
				'title'	=> 'Profile',
				'body'	=> 'templates.account',
				'data' 	=> array(
					'body'	=> 'account.profile',
					'data'	=> array(
						'user' 		=> $user,
						'inputs' 	=> $inputs,
						'errors'	=> $validation->errors->messages
					)
				)
			);
			return View::make('templates.base', $template);
		}
		else {
			// upload picture
			if($inputs['picture']['size']) {
				// validate picture
				if(!preg_match('/^image/', $inputs['picture']['type'])) {
					Session::flash('error', 'Your picture was not saved. Please upload only a file type image.');
				}
				if(!intval($inputs['picture']['size'] < 500000)) {
					Session::flash('error', 'Your picture was not saved. Please upload only a file less than 500kb.');
				}
				$filename = $user->username .'_'. timestamp() .'.'. File::extension($inputs['picture']['name']);
				$upload = Input::upload('picture', $_SERVER['DOCUMENT_ROOT'] . Config::get('shortcuts.user_picture'), $filename);
			}
			// update a row
			$user->display_name	= $inputs['display_name'];
			$user->email 		= $inputs['email'];
			$user->phone 		= $inputs['phone'];
			$user->description 	= $inputs['description'];
			$user->picture_url	= (isset($upload) && $upload)? $filename : $user->picture_url;
			$user->save();
			// flash and redirect
			Session::flash('info', 'Your profile has been successfully updated.');
			return Redirect::to('/account/profile');
		}
	}
	
	public function action_password()
	{
		$user = User::find(Auth::user()->id);
		// get input data
		$passwords = Input::all();
		// define the validation rules
		$rules = array(
			'current_password'	=> 'required',
			'password'			=> 'required|min:6|confirmed',
		);
		// validate the data
		$validation = Validator::make($passwords, $rules);
		// check whether to display the form or not
		if($validation->fails()) {
			// build view
			$template = array(
				'title'	=> 'Password',
				'body'	=> 'templates.account',
				'data' 	=> array(
					'body'	=> 'account.password',
					'data'	=> array(
						'user' 		=> $user,
						'passwords' => $passwords,
						'errors'	=> $validation->errors->messages
					)
				)
			);
			return View::make('templates.base', $template);
		}
		else {
			// match current password
			if(!Hash::check($passwords['current_password'], $user->password)) {
				// flash and redirect
				Session::flash('error', 'You must enter the correct password for Current Password field.');
				return Redirect::to('/account/password');
			}
			// update password
			$user->password = Hash::make($passwords['password']);
			$user->save();
			// flash and redirect
			Session::flash('info', 'You have successfully changed your password.');
			return Redirect::to('/account/profile');
		}
	}
	
	public function action_facebook()
	{
		$user_facebook = UserFacebook::where('user_id', '=', Auth::user()->id)->first();
		// view
		$template = array(
			'title'	=> 'Facebook',
			'body'	=> 'templates.account',
			'data' 	=> array(
				'body'	=> 'account.facebook',
				'data'	=> array(
					'status' => Session::get('facebook_login'),
					'username' => Session::get('facebook_name'),
					'page' => isset($user_facebook->page_name)? $user_facebook->page_name : null,
				)
			)
		);
		return View::make('templates.base', $template);
	}
}
