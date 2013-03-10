<?php

class UserPost extends Eloquent
{
	public static $table = 'user_posts';
	
	public function user()
	{
		return $this->belongs_to('User');
	}
	
	public static function complete()
	{
		$sql = "select user_posts.*, users.username, user_meta.display_name from user_posts
				left join users on user_posts.user_id = users.id
				left join user_meta on user_posts.user_id = user_meta.user_id";
		return DB::query($sql);
	}
}
