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

Route::get('/', function () {
    return view('welcome');
});

Route::get('start', function () {
    $user = Socialite::driver('katsana')->userFromToken(Session::get('token'));

    dd($user->user);
});

Route::get('social/connect', 'Auth\SocialController@redirectToProvider');
Route::get('social/callback', 'Auth\SocialController@handleProviderCallback');
