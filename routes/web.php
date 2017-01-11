<?php

use Illuminate\Routing\Router;

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

$router->get('start', function () {
    $user = Socialite::driver('katsana')->userFromToken(Session::get('token'));

    dd($user->user);
})->middleware('auth');

$router->group(['middleware' => 'guest'], function (Router $router) {
    $router->get('/', function () {
        return view('welcome');
    });

    $router->group(['prefix' => 'social'], function (Router $router) {
        $router->get('connect', 'Auth\SocialController@redirectToProvider');
        $router->get('callback', 'Auth\SocialController@handleProviderCallback');
    });
});
