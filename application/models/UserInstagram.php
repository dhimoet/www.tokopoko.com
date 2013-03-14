<?php

class UserInstagram extends Eloquent
{
	public static $table = 'user_instagram';
	
	public function user()
	{
		return $this->has_one('User');
	}
}
