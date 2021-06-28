<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if ($user->account_status_id == 1) {
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(['status' => 'info', 'message' => 'Your account is not active or under review'], 403);
        }
        if ($user->account_status_id == 3) {
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(['status' => 'info', 'message' => 'Your account has been suspended'], 403);
        }
    }
    public function showLoginForm()
    {
        return view('pages.user-login');
    }

}
