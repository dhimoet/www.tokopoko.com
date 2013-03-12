<?php

class Help_Controller extends Base_Controller {
		
	public function __construct()
	{
		
	}

	public function action_index()
	{
		return Redirect::to('/help/about');
	}
	
	public function action_about()
	{
		$template = array(
			'title'	=> 'About',
			'body'	=> 'templates.help',
			'data' 	=> array(
				'body'	=> 'help.about',
				'data'	=> array()
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_howto()
	{
		$template = array(
			'title'	=> 'About',
			'body'	=> 'templates.help',
			'data' 	=> array(
				'body'	=> 'help.howto',
				'data'	=> array()
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_rules()
	{
		$template = array(
			'title'	=> 'About',
			'body'	=> 'templates.help',
			'data' 	=> array(
				'body'	=> 'help.rules',
				'data'	=> array()
			)
		);
		return View::make('templates.base', $template);
	}
	
	public function action_contact()
	{
		$template = array(
			'title'	=> 'About',
			'body'	=> 'templates.help',
			'data' 	=> array(
				'body'	=> 'help.contact',
				'data'	=> array()
			)
		);
		return View::make('templates.base', $template);
	}
}
