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

Route::any('/', function() {
	return Redirect::to(action('TimerController@index'));
});

Route::resource('/timers', 'TimerController');
Route::post('/timers/{timers}/reset', [
    'uses' => 'TimerController@resetStopwatch'
]);

Route::put('/timezone', [
    'uses' => 'TimezoneController@setTimezone'
]);

Route::get('/login', [
    'uses' => 'AuthController@showLogin',
    'as' => 'login',
    'before' => 'guest'
]);

Route::post('/login', [
    'uses' => 'AuthController@login',
    'before' => 'csrf'
]);

Route::get('/logout', [
    'uses' => 'AuthController@logout',
    'as' => 'logout'
]);
