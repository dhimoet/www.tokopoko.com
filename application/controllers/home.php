<?php

class Home_Controller extends Base_Controller {

	public function action_index()
	{
		$template = array(
			'title'	=> 'Home',
			'body'	=> 'home.index',
			'data' 	=> array()
		);
		return View::make('templates.base', $template);
	}
	
	public function action_user($username)
	{
		$user = User::where('username', '=', $username)->first();
		$user_facebook = UserFacebook::where('user_id', '=', $user->id)->first();
		$template = array(
			'title'	=> $user->display_name,
			'body'	=> 'home.user',
			'data' 	=> array(
				'user' => $user,
				'user_facebook' => $user_facebook
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_ajax_get_posts()
	{
		// check if cached
		if(!Cache::get('user_posts')) {
			// get all posts from facebook users
			$fh = new FacebookHelper;
			$fh->fetch_posts();
			$user_posts = UserPost::with('user')->order_by('object_updated_time', 'desc')->take(10)->get();
			Cache::put('user_posts', json_encode($user_posts), 15);
			echo json_encode($user_posts);
		}
		else {
			echo Cache::get('user_posts');
		}
		die;
	}
}