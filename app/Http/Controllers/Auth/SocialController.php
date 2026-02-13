<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class SocialController extends Controller
{
    /**
     * Redirect the user to the Katsana authentication page.
     */
    public function redirectToProvider(): Response
    {
        return Socialite::driver('katsana')->redirect();
    }

    /**
     * Obtain the user information from Katsana.
     */
    public function handleProviderCallback(): RedirectResponse
    {
        $user = Socialite::driver('katsana')->user();

        session()->put('token', $user->token);

        return redirect('start');
    }
}
