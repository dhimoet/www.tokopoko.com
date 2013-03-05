<?php

class Facebook_Controller extends Base_Controller 
{	
	public function action_index()
	{
		return Redirect::to('/facebook/login');
	}
	
	public function action_login()
	{
		// attempt login
		$fh = new FacebookHelper;
		return Redirect::to($fh->login());
	}
	
	public function action_logout()
	{
		// attempt logout
		$fh = new FacebookHelper;
		return Redirect::to($fh->logout());
	}
	
	public function action_page()
	{
		$input = Input::all();
		// check what to do
		if(empty($input)) {
			// disconnect facebook page
			$fh = UserFacebook::where('user_id', '=', Auth::user()->id)->first();
			$fh->page_name = null;
			$fh->save();
		}
		else {
			// connect facebook page
			$fh = new FacebookHelper;
			$fh->connect_page($input['facebook_page']);
		}
		return Redirect::to('/account/facebook');
	}
}