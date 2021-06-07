<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['account_statuses'] = Models\AccountStatus::get();
        $data['users'] = Models\User::with('account_status')->latest()->get();
        return $data;
    }

    public function update(Request $request, $user_id)
    {
        $user = Models\User::id($user_id)->first();
        $user->account_status_id = $request->account_status_id;
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'User data updated'], 200);
    }
}
