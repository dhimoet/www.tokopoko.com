<?php

class Home_Controller extends Base_Controller {

	public function action_index()
	{
		$template = array(
			'title'	=> 'Home',
			'body'	=> 'home.index',
			'data' 	=> array(
				'nocache' => Input::get('nocache')
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_user($username)
	{
		$user = User::where('username', '=', $username)->first();
		if(empty($user)) {
			return Response::error('404');
		}
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
		$force_refresh = Input::get('nocache');
		// check if cached
		if(!Cache::get('user_posts') || $force_refresh) {
			// get all posts from facebook users
			$fh = new FacebookHelper;
			$fh->fetch_posts();
			$ih = new InstagramHelper;
			$ih->fetch_posts();
			$user_posts = UserPost::with('user')->order_by('object_updated_time', 'desc')->paginate(10);
			Cache::put('user_posts', json_encode($user_posts), Config::get('shortcuts.cache_duration'));
			echo json_encode($user_posts);
		}
		else {
			$user_posts = UserPost::with('user')->order_by('object_updated_time', 'desc')->paginate(10);
			echo json_encode($user_posts);
		}
		die;
	}
}