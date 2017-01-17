<?php

use Illuminate\Routing\Router;
use Katsana\Sdk\Exceptions\UnauthorizedHttpException;

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

$router->group(['prefix' => '{version?}'], function (Router $router) {
    $router->get('start', function () {
        try {
            $user = Socialite::driver('katsana')->userFromToken(Session::get('token'));
        } catch (UnauthorizedHttpException $e) {
            Session::forget('token');
            return redirect('/');
        }

        dd($user->user);
    })->middleware('auth');

    $router->get('{filename}', 'DocumentationController@show');
    $router->get('/', 'DocumentationController@index');

    $router->group(['middleware' => 'guest'], function (Router $router) {
        $router->group(['prefix' => 'social'], function (Router $router) {
            $router->get('connect', 'Auth\SocialController@redirectToProvider');
            $router->get('callback', 'Auth\SocialController@handleProviderCallback');
        });
    });
});
