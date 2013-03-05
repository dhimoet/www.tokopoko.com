<?php

class Home_Controller extends Base_Controller {

	public function action_index()
	{
		$template = array(
			'title'	=> 'Home',
			'body'	=> 'home.index',
			'data' 	=> array(
				'posts' => UserPost::order_by('object_updated_time', 'desc')->take(20)->get()
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_ajax_get_posts()
	{
		// get all posts from facebook users
		$fh = new FacebookHelper;
		$fh->fetch_posts();
		$user_posts = UserPost::order_by('object_updated_time', 'desc')->take(20)->get();
		echo json_encode($user_posts);
		die;
	}
}