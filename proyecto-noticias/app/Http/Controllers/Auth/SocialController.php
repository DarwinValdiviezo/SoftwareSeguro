<?php
// app/Http/Controllers/Auth/SocialController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
                        ->redirect();
    }

    public function callback()
    {
        // IMPORTANTE: stateless() para saltar la comprobación de state en sesión
        $info = Socialite::driver('google')
                         ->stateless()
                         ->user();

        $user = User::firstOrCreate(
            ['email'    => $info->getEmail()],
            [
                'name'     => $info->getName(),
                'password' => bcrypt(Str::random(16)),
            ]
        );

        if (! $user->hasRole('user')) {
            $user->assignRole('user');
        }

        Auth::login($user);

        return redirect()->route('news.index');
    }
}
