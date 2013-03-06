<?php

class FacebookHelper
{
	protected $facebook = null;
	
	public function __construct()
	{
		$this->facebook = new Facebook(Config::get('keys.facebook'));
	}

	public function login()
	{
		// check login status
		if(!$this->facebook->getUser()) {
			// login user
			$params = array(
				'scope' 		=> 'user_status,user_photos,user_events,publish_actions',
				'display' 		=> 'popup'
			);
			return $this->facebook->getLoginUrl($params);
		}
		else {
			// find user facebook
			$user_facebook = UserFacebook::where('user_id', '=', Auth::user()->id)->first();
			if(empty($user_facebook)) {
				// create a new object
				$user_facebook = new UserFacebook;
				$user_facebook->user_id = Auth::user()->id;
			}
			// store facebook user id
			$user_facebook->uid = $this->facebook->getUser();
			$user_facebook->token = $this->facebook->getAccessToken();
			$user_facebook->save();
			// extend facebook access token
			$this->facebook->setExtendedAccessToken();
			// store login status in session
			Session::put('facebook_login', true);
			Session::put('facebook_token', $this->facebook->getAccessToken());
			Session::put('facebook_name', isset($me['name'])? $me['name'] : null);
			return '/account/facebook';
		}
	}
	
	public function login_with_token()
	{
		// get user facebook data
		$user_facebook = UserFacebook::where('user_id', '=', Auth::user()->id)->first();
		// check if user has a facebook account
		if(!empty($user_facebook)) {
			// use the token
			$this->facebook->setAccessToken($user_facebook->token);
			// extend facebook access token
			$this->facebook->setExtendedAccessToken();
			// check login status
			if(!$this->facebook->getUser()) {
				// flash message
				Session::flash('error', 'Your Facebook access token has expired. Please <a href="/facebook/login">login</a> again.');
			}
			else {
				$me = $this->facebook->api('/me');
				// store login status in session
				Session::put('facebook_login', true);
				Session::put('facebook_token', $user_facebook->token);
				Session::put('facebook_name', $me['name']);
			}
		}
	}
	
	public function logout()
	{
		// check login status
		if($this->facebook->getUser()) {
			// logout user facebook
			$this->facebook->destroySession();
			$params = array(
				'next' => URL::base() .'/facebook/logout',
				'access_token' => $this->facebook->getAccessToken()
			);
			return $this->facebook->getLogoutUrl($params);
		}
		Session::forget('facebook_login');
		return '/account/facebook';
	}
	
	public function fetch_posts()
	{
		// get all latest users facebook posts
		$user_facebook = UserFacebook::all();
		// loop
		foreach($user_facebook as $uf) {
			// get latest posts
			$posts = $this->facebook->api("/{$uf->uid}/posts?access_token={$uf->token}");
			$this->store_posts($posts, $uf->token);
			// check for facebook page
			if(!empty($uf->page_name)) {
				// get latest posts
				$posts = $this->facebook->api("/{$uf->page_name}/posts?access_token={$uf->token}");
				$this->store_posts($posts, $uf->token);
			}
		}
	}
	
	public function store_my_posts()
	{
		// check login status
		if($this->facebook->getUser()) {
			// get latest posts
			$posts = $this->facebook->api('/me/posts');
			$this->store_posts($posts, $this->facebook->getAccessToken());
		}
	}
	
	public function store_posts($posts, $token)
	{
		foreach($posts['data'] as $post) {
			// check post type
			if($post['type'] == 'photo') {
				// get image source
				$this->facebook->setAccessToken($token);
				$image = $this->facebook->api("/{$post['object_id']}");
				$user_post = UserPost::where('object_id', '=', $image['id'])->first();
				// check if exists
				if(empty($user_post)) {
					// create a new object
					$user_post = new UserPost;
					$user_post->object_id = $image['id'];
					$user_post->owner_id = $image['from']['id'];
					$user_post->owner_name = $image['from']['name'];
					$user_post->image_name = isset($image['name'])? $image['name'] : null;
					$user_post->image_url = $image['source'];
					$user_post->page_url = $image['link'];
					$user_post->location = isset($image['place']['name'])? $image['place']['name']: null;
					$user_post->object_updated_time = date('Y-m-d H:i:s', strtotime($post['updated_time']));
					$user_post->save();
				}
			}
		}
		// set back to user's token
		$this->facebook->setAccessToken(Session::get('facebook_token'));
	}
	
	public function connect_page($page_name)
	{
		// get user facebook
		$user_facebook = UserFacebook::where('user_id', '=', Auth::user()->id)->first();
		$user_facebook->page_name = $page_name;
		$user_facebook->save();
	}
	
	public function api($param)
	{
		$response = $this->facebook->api($param);
		return $response;
	}
}
