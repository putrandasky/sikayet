<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function __invoke()
    {
        return Auth::guard('admin')->user();

    }
}
