<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	$wfb = Session::get('wfb');
	$user = Session::get('user');
	// var_dump($wfb.' - '.$user);
	if(isset($wfb['user_profile']['id']) && isset($user['token'])) return Redirect::to('/items');
	Session::flush();
	return View::make('index');
});

Route::get('fb', 'AccountController@login');

// Route::get('fb', function() {});

Route::get('items', 'ItemsController@get');
Route::post('items/send', 'ItemsController@send');

Route::get('items/calculate', 'ItemsController@cal');

Route::get('logout', function() {
	Session::flush();
	return Redirect::to('/');
});

// Route::get('results', function() {
// 	return View::make('results');
// });

Route::get('payment/{pay}', 'PaypalPaymentController@create');
Route::get('payment/info/{paymentID}/{pay}', 'PaypalPaymentController@info');
Route::get('paypal', function() {
	Log::info('paypal:', Input::all());
	var_dump(Input::all());
	// return Redirect::to('/');
});

Route::get('leaderboard', 'BoardController@get');
Route::get('profile', 'BoardController@profile');

