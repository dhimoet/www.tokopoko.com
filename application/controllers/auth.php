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
				$user = User::where('username', '=', $login['username'])->first();
				$user->last_login = date('Y-m-d H:i:s', strtotime('now'));
				$user->save();
				// store latest posts
				$fh->login_with_token();
				$fh->store_my_posts();
				return Redirect::to('/account/profile');
			}
			Session::flash('error', '<strong>Error!</strong> Invalid username or password.');
		}
		// display login form
		$template = array(
			'title'	=> 'Login',
			'body'	=> 'auth.login',
			'data' 	=> array()
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
			'displayname'	=> 'required',
			'username'		=> 'required|min:4|alpha_dash|unique:users',
			'password'		=> 'required|min:6|confirmed',
			'email'			=> 'required|email|unique:users',
			'phone'			=> 'integer'
		);
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
			$user->display_name 	= $register['displayname'];
			$user->password			= Hash::make($register['password']);
			$user->email			= $register['email'];
			$user->phone		 	= $register['phone'];
			$user->last_login		= date('Y-m-d H:i:s', strtotime('now'));
			$user->status			= 'active';
			$user->save();
			// redirect
			return Redirect::to('/');
		}
		
	}
}