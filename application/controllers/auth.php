<?php

class Auth_Controller extends Base_Controller 
{
	public function action_index()
	{
		return Redirect::to('/auth/login');
	}
	
	public function action_login()
	{
		$fh = new FacebookHelper;
		// check if logged in
		if(Auth::check()) {
			// user is logged in
			// store latest posts
			$fh->login_with_token();
			$fh->store_my_posts();
			return Redirect::to('/account/profile');
		}
		// get input data
		$input = Input::all();
		// check whether to display the form or not
		if(isset($input['login'])) {
			$login = $input['login'];
			// collect credentials
			$credentials = array(
				'username'	=> $login['username'],
				'password'	=> $login['password']
			);
			// attempt to login
			if(Auth::attempt($credentials)) {
				// success
				// store latest posts
				$fh->login_with_token();
				$fh->store_my_posts();
				return Redirect::to('/account/profile');
			}
			$errors = true;
		}
		else {
			$errors = false;
		}
		// display login form
		$template = array(
			'title'	=> 'Login',
			'body'	=> 'auth.login',
			'data' 	=> array(
				'errors' => $errors
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_logout()
	{
		// logout user
		Auth::logout();
		// redirect to homepage
		return Redirect::home();
	}
	
	public function action_register()
	{
		// get input data
		$input = Input::all();
		$register = isset($input['register'])? $input['register'] : null;
		// define the validation rules
		$rules = array(
			'username'	=> 'required|min:4|alpha_dash|unique:users',
			'password'	=> 'required|min:6|confirmed',
			'email'		=> 'required|email|unique:users',
			'phone'		=> 'integer'
		);
		// check registration type
		if($register['type'] == 'individual') {
			$rules['firstname'] = 'required|alpha';
			$rules['lastname'] = 'required|alpha';
		}
		else {
			$rules['displayname'] = 'required';
		}
		// validate the data
		$validation = Validator::make($register, $rules);
		// check whether to display the form or not
		if($validation->fails()) {
			// display registration form
			$template = array(
				'title'	=> 'Register',
				'body'	=> 'auth.register',
				'data' 	=> array(
					'register'	=> $register,
					'errors'	=> $validation->errors->messages
				)
			);
			return View::make('templates.base', $template);
		}
		else {
			// store to users table
			$user = new User;
			$user->username			= $register['username'];
			$user->password			= Hash::make($register['password']);
			$user->email			= $register['email'];
			$user->group			= $register['type'];
			$user->last_login		= date('Y-m-d H:i:s', strtotime('now'));
			$user->status			= 'active';
			$user->save();
			// store to user_meta table
			$user_meta = new UserMeta;
			$user_meta->user_id = $user->id;
			$user_meta->first_name = $register['firstname'];
			$user_meta->last_name = $register['lastname'];
			$user_meta->display_name = $register['displayname'];
			$user_meta->json_emails = json_encode(array($register['email']));
			$user_meta->phone = $register['phone'];
			$user_meta->save();
			// redirect
			return Redirect::to('/');
		}
		
	}
}