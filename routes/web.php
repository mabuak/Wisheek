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

Route::get('/',['uses' => 'FE\HomeController@index', 'as' => 'home.home']);

// Register
Route::get('/register', ['uses' => 'FE\RegisterController@getRegister', 'as' => 'register.getRegister']);
Route::get('/register/code', ['uses' => 'FE\RegisterController@getCode', 'as' => 'register.code']);
Route::post('/register', ['uses' => 'FE\RegisterController@postRegister', 'as' => 'register.postRegister']);
Route::get('/welcome', ['uses' => 'FE\RegisterController@sendWelcomeEmail']);

// Auth
Route::get('/login', ['uses' => 'FE\AuthController@getLogin', 'as' => 'auth.getLogin']);
Route::post('/login', ['uses' => 'FE\AuthController@postLogin', 'as' => 'auth.postLogin']);
Route::any('/logout', ['uses' => 'FE\AuthController@getLogout', 'as' => 'auth.logout']);


Route::get('social/auth/redirect/{provider}', ['uses'=>'FE\AuthController@redirectToProvider','as'=>'auth.social']);
Route::get('social/auth/{provider}', ['uses'=>'FE\AuthController@handleProviderCallback', 'as'=>'auth.social']);

// Password reset link request routes...
Route::get('password/email', ['uses'=>'FE\ReminderController@getEmail','as'=>'remind.getEmail']);
Route::post('password/email', ['uses'=>'FE\ReminderController@postEmail','as'=>'remind.postEmail']);

// Password reset routes...
Route::get('password/reset/{token}', 'FE\ReminderController@getReset');
Route::post('password/reset/{token}', 'FE\ReminderController@postReset');

//Scrape
Route::post('/scrape', array('uses' =>'FE\ScrapeController@scrape'));

//Pins
<<<<<<< HEAD
Route::resource('pin', 'PinController');
=======
>>>>>>> origin/master
Route::get('pin/{hash}', ['uses'=>'FE\PinController@show','as'=>'pin.show']);
Route::get('pin/{hash}/edit', ['uses'=>'FE\PinController@edit','as'=>'pin.edit']);
Route::get('/pins/grid', 'FE\PinController@grid');
