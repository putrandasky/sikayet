<?php

namespace App\Http\Controllers\AuthCompany;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function __construct()
    {
        $this->middleware('guest:companies')->except('logout');
    }
    public function showLoginForm()
    {
        return view('pages.company-login');
    }
    protected function redirectPath()
    {
        return route('company-login');
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
    protected function guard()
    {
        return Auth::guard('company');
    }

}
