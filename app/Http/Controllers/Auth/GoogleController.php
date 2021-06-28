<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use ImageResize;
use Redirect;
use Socialite;
use Storage;
use Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {

        if (Auth::check()) {
            return redirect('/user-dashboard');
        }

        $oauthUser = Socialite::driver('google')->stateless()->user();
        $user = Models\User::where('google_id', $oauthUser->id)->first();
        if ($user) {
            Auth::loginUsingId($user->id);
            return redirect('/user-dashboard');
        } else {
//check if any user has same email
            $user_email_exist = Models\User::where('email', $oauthUser->email)->exists();

            if ($user_email_exist) {
                return redirect('user-login')->with('status', 'You can not using Google login with Email which already registered');
            }

            $content = file_get_contents($oauthUser->avatar_original);
            $filename = Str::random(20) . '.jpg';
            $stored_avatar = Storage::put('public/user/' . $filename, $content);
            $img128 = ImageResize::make($content);
            $img128->resize(128, 128, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/user/tmb128-' . $filename));

            $newUser = Models\User::create([
                'name' => $oauthUser->name,
                'email' => $oauthUser->email,
                'google_id' => $oauthUser->id,
                'avatar' => $filename,
                'account_status_id' => 1,
                'slug' => md5($oauthUser->email),
                //password will never be used
                'password' => md5($oauthUser->token),
            ]);
            Auth::login($newUser);
            return redirect('/user-dashboard');
        }
    }
}
