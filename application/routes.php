<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function()
{
	return View::make('home.index');
});
Route::get('/(:any)', function($username)
{
	return Redirect::to('/home/user/'. $username);
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/

Route::filter('before', function()
{
	$open_routes = array(
		'', 
		'home', 
		'auth', 
		'help'
	);
	if(!in_array(URI::segment(1), $open_routes) && Auth::guest()) {
		return Redirect::to('/auth/login');
	}
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/auth/login');
});
	
/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::group(array('before' => 'auth'), function() 
{
	//
});

/*
|--------------------------------------------------------------------------
| Controller Routes
|--------------------------------------------------------------------------
*/

Route::controller(Controller::detect());
