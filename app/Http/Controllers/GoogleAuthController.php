<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('email', $user->getEmail())->first();

            if (!$finduser) {
                $new_user = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                ]);

                Auth::login($new_user);

                return redirect()->route('dashboard');
            }else{
                Auth::login($finduser);

                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
