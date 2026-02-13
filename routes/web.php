<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Katsana\Sdk\Exceptions\UnauthorizedHttpException;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

Route::prefix('{version?}')->group(function () {
    Route::get('start', function () {
        try {
            $user = Socialite::driver('katsana')->userFromToken(Session::get('token'));
        } catch (UnauthorizedHttpException $e) {
            Session::forget('token');
            return redirect('/');
        }

        dd($user->user);
    })->middleware('auth');

    Route::get('{filename}', [DocumentationController::class, 'show'])->where('filename', '(.+)?');
    Route::get('/', [DocumentationController::class, 'index']);

    Route::middleware('guest')->prefix('social')->group(function () {
        Route::get('connect', [SocialController::class, 'redirectToProvider']);
        Route::get('callback', [SocialController::class, 'handleProviderCallback']);
    });
});
