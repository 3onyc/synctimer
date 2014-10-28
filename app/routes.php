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

Route::get('/', [
    'uses' => 'HomeController@showWelcome',
    'as' => 'home',
    'before' => 'auth'
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
