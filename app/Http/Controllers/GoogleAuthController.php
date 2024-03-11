<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            // $code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
            $code = Str::random(6);
            if (!$finduser) {
                $new_user = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'profile_photo_path' => $user->getAvatar(),
                    'role_id' => 2,
                ]);

                Auth::login($new_user);
                session(['verification_code' => $code]);
                Mail::to($new_user->email)->send(new VerificationCode($code));
                return redirect()->route('dashboard');
            }else{
                Auth::login($finduser);
                if($finduser->is_verified === 0)
                {
                    session(['verification_code' => $code]);
                    Mail::to($finduser->email)->send(new VerificationCode($code));
                }
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
