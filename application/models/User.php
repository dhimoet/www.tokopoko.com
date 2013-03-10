<?php

class User extends Eloquent
{
	public static $table = 'users';
	
	public function user_posts()
	{
		return $this->has_one('UserPost', 'user_id');
	}
}
