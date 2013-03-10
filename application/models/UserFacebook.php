<?php

class UserFacebook extends Eloquent
{
	public static $table = 'user_facebook';
	
	public function user()
	{
		return $this->has_one('User');
	}
}
