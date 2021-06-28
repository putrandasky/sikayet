<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = Models\User::where('email', $request->input('email'))->first();
        if ($user) {

            if ($user->facebook_id) {
                return back()->with('status', 'This email is registered with Facebook login, please reset password from facebook');
            }
            if ($user->google_id) {
                return back()->with('status', 'This email is registered with Google login, please reset password from Google');
            }
        }

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($request, $response)
        : $this->sendResetLinkFailedResponse($request, $response);
    }

}
