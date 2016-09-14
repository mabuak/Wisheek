<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',['uses' => 'HomeController@index', 'as' => 'home.home']);

// Register
Route::get('/register', ['uses' => 'RegisterController@getRegister', 'as' => 'register.getRegister']);
Route::get('/register/code', ['uses' => 'RegisterController@getCode', 'as' => 'register.code']);
Route::post('/register', ['uses' => 'RegisterController@postRegister', 'as' => 'register.postRegister']);
Route::get('/welcome', ['uses' => 'RegisterController@sendWelcomeEmail']);

// Auth
Route::get('/login', ['uses' => 'AuthController@getLogin', 'as' => 'auth.getLogin']);
Route::post('/login', ['uses' => 'AuthController@postLogin', 'as' => 'auth.postLogin']);
Route::any('/logout', ['uses' => 'AuthController@getLogout', 'as' => 'auth.logout']);

Route::get('social/auth/redirect/{provider}', ['uses'=>'AuthController@redirectToProvider','as'=>'auth.social']);
Route::get('social/auth/{provider}', ['uses'=>'AuthController@handleProviderCallback', 'as'=>'auth.social']);

// Password reset link request routes...
Route::get('password/email', ['uses'=>'ReminderController@getEmail','as'=>'remind.getEmail']);
Route::post('password/email', ['uses'=>'ReminderController@postEmail','as'=>'remind.postEmail']);

// Password reset routes...
Route::get('password/reset/{token}', 'ReminderController@getReset');
Route::post('password/reset/{token}', 'ReminderController@postReset');

//Users
Route::post('/welcome/disable', array('uses' =>'UserController@disableWelcome'));

//Scrape
Route::post('/scrape', array('uses' =>'ScrapeController@scrape'));

//Pins
Route::resource('pin', 'PinController');
Route::get('pin/{hash}', ['uses'=>'PinController@show','as'=>'pin.show']);
