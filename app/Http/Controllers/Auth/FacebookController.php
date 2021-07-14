<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use Hash;
use Illuminate\Http\Request;
use ImageResize;
use Socialite;
use Storage;
use Str;
use URL;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->with(['state' => URL::previous()])->redirect();
    }

    public function callback(Request $request)
    {
        $url = $request->input('state');
        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect('/user-dashboard');
        }

        $oauthUser = Socialite::driver('facebook')->stateless()->user();
        $user = Models\User::where('facebook_id', $oauthUser->id)->first();
        if ($user) {
            Auth::loginUsingId($user->Id);
            return redirect($url);
        } else {
            //check if any user has same email
            $user_email_exist = Models\User::where('email', $oauthUser->email)->exists();

            if ($user_email_exist) {
                return redirect($url)->with('status', 'You can not using Facebook login with Email which already registered');
            }

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
            return redirect($url);
        }
    }
}
