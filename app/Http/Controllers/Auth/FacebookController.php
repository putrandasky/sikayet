<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use Hash;
use ImageResize;
use Socialite;
use Storage;
use Str;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function callback()
    {

        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect('/user-dashboard');
        }

        $oauthUser = Socialite::driver('facebook')->stateless()->user();
        $user = Models\User::where('facebook_id', $oauthUser->id)->first();
        if ($user) {
            Auth::loginUsingId($user->Id);
            return redirect('/user-dashboard');
        } else {
            $content = file_get_contents($oauthUser->avatar_original . "&access_token={$oauthUser->token}");
            $filename = Str::random(20) . '.jpg';
            $stored_avatar = Storage::put('public/user/' . $filename, $content);
            $img128 = ImageResize::make($content);
            $img128->resize(128, 128, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/user/tmb128-' . $filename));

            $newUser = Models\User::create([
                'name' => $oauthUser->getName(),
                'email' => $oauthUser->getEmail(),
                'facebook_id' => $oauthUser->getId(),
                'avatar' => $filename,
                'account_status_id' => 1,
                'slug' => md5($oauthUser->getEmail()),
                // password tidak akan digunakan ;)
                'password' => Hash::make(md5($oauthUser->getEmail())),
            ]);
            Auth::login($newUser);
            return redirect('/user-dashboard');
        }
    }
}
