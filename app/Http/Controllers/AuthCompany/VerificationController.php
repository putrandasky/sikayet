<?php

namespace App\Http\Controllers\AuthCompany;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
     */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/company-login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function verify(Request $request)
    {
        // if (!hash_equals((string) $request->route('id'), (string) $request->user('company')->getKey())) {
        //     throw new AuthorizationException;
        // }

        // if (!hash_equals((string) $request->route('hash'), sha1($request->user('company')->getEmailForVerification()))) {
        //     throw new AuthorizationException;
        // }

        $user = Models\Company::id($request->route('id'))->first();
        if (!$user) {
            throw new AuthorizationException;
        }
        if (!hash_equals((string) $request->route('hash'), sha1($user->email))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            $user->is_verified = 1;
            $user->save();
            event(new Verified($user));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect($this->redirectPath())->with('status', 'Your Email Has Been Verified');
    }
    public function __construct()
    {
        // $this->middleware('auth:company');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
