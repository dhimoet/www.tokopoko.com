<?php

class Instagram_Controller extends Base_Controller 
{	
	public function action_index()
	{
		return Redirect::to('/facebook/login');
	}
	
	public function action_login()
	{
		$ih = new InstagramHelper;
		// attempt login
		return Redirect::to($ih->login());
	}
	
	public function action_logout()
	{
		$ih = new InstagramHelper;
		return Redirect::to($ih->logout());
	}
	
	public function action_authenticate()
	{
		$inputs = Input::all();
		$ih = new InstagramHelper;
		$ih->authenticate($inputs);
		//done
		return Redirect::to('/account/instagram');
	}
}