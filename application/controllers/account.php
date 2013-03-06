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
	
	public function action_profile()
	{
		// display registration form
		$template = array(
			'title'	=> 'Profile',
			'body'	=> 'templates.account',
			'data' 	=> array(
				'body'	=> 'account.profile',
				'data'	=> array()
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_facebook()
	{
		$user_facebook = UserFacebook::where('user_id', '=', Auth::user()->id)->first();
		// view
		$template = array(
			'title'	=> 'Login to Facebook',
			'body'	=> 'templates.account',
			'data' 	=> array(
				'body'	=> 'account.facebook',
				'data'	=> array(
					'status' => Session::get('facebook_login'),
					'username' => Session::get('facebook_name'),
					'page' => $user_facebook->page_name,
				)
			)
		);
		return View::make('templates.base', $template);
	}
}