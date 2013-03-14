<?php

class InstagramHelper
{
	protected $keys = null;
	protected $redirect = null;
	
	public function __construct()
	{
		$this->keys = Config::get('keys.instagram');
		$this->redirect = URL::base() . '/instagram/authenticate';
	}
	
	public function login()
	{
		return "https://api.instagram.com/oauth/authorize/?client_id={$this->keys['client_id']}&redirect_uri={$this->redirect}&response_type=code";
	}
	
	public function authenticate($inputs)
	{
		// get token
		if(!isset($inputs['code'])) {
			Session::flash('error', 'Missing parameter(s).');
			return Redirect::to('/account/instagram');
		}
		elseif (isset($inputs['error'])) {
			Session::flash('error', $inputs['error']);
			return Redirect::to('/account/instagram');
		}
		// test auth code
		$curl = new Curl;
		$params = array(
			'client_id' 	=> $this->keys['client_id'],
			'client_secret' => $this->keys['client_secret'],
			'grant_type' 	=> 'authorization_code',
			'redirect_uri' 	=> $this->redirect,
			'code' 			=> $inputs['code']
		);
		$response = $curl->simple_post('https://api.instagram.com/oauth/access_token', $params);
		$response = json_decode($response);
		// check response
		if(!isset($response->access_token) || empty($response->access_token)) {
			Session::flash('error', 'Authentication process failed.');
			return Redirect::to('/account/instagram');
		}
		// find existing user instagram
		$ui = UserInstagram::where('user_id', '=', Auth::user()->id)->first();
		if(empty($ui)) {
			// create a new entry
			$ui = new UserInstagram;
			$ui->user_id = Auth::user()->id;
		}
		// store auth code
		$ui->uid 		= $response->user->id;
		$ui->auth_code 	= $inputs['code'];
		$ui->token 		= $response->access_token;
		$ui->save();
		// done
		Session::flash('info', 'Authentication processed successfully.');
		return $ui;
	}

	public function logout()
	{
		// delete token from database
		$ui = UserInstagram::where('user_id', '=', Auth::user()->id)->first();
		if(!empty($ui)) {
			$ui->auth_code = null;
			$ui->token = null;
			$ui->save();
		}
		return '/account/instagram';
	}

	public function fetch_posts()
	{
		$curl = new Curl;
		// get all latest users facebook posts
		$user_instagram = UserInstagram::all();
		// loop
		foreach($user_instagram as $ui) {
			$api = "https://api.instagram.com/v1/users/{$ui->uid}/media/recent/?access_token={$ui->token}&count=5";
			$response = $curl->simple_get($api);
			$response = json_decode($response);
			// loop
			$this->store_posts($ui->user_id, $response);
		}
	} 

	public function store_posts($user_id, $response)
	{
		foreach($response->data as $post) {
			// check if exists
			$up = UserPost::where('object_id', '=', $post->id)->first();
			if(empty($up)) {
				// create a new object
				$up = new UserPost;
				$up->user_id = $user_id;
				$up->object_id = $post->id;
				$up->owner_id = $post->user->id;
				$up->owner_name = $post->user->full_name;
				$up->image_name = isset($post->caption->text)? $post->caption->text : null;
				$up->image_url = $post->images->standard_resolution->url;
				$up->page_url = $post->link;
				$up->location = $post->location;
				$up->object_updated_time = date('Y-m-d H:i:s', $post->created_time);
				$up->source = 'instagram';
				$up->save();
			}
		}
	}
	
	public function check()
	{
		$curl = new Curl;
		$ui = UserInstagram::where('user_id', '=', Auth::user()->id)->first();
		if(empty($ui)) {
			return false;
		}
		$api = "https://api.instagram.com/v1/users/self/feed?access_token={$ui->token}";
		$response = $curl->simple_get($api);
		$response = json_decode($response);
		// return true if token valid
		return !empty($response);
	}
}
