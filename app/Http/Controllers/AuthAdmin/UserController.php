<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $guard = $this->guard();

        if ($guard->user()) {
            return Models\Admin::paginate(10);
        }

        return response()->json(["message" => "Forbidden"], 403);
    }
    public function updateProfile(Request $request)
    {
        $guard = $this->guard();

        if ($guard->user()) {
            $rules = [
                'name' => 'required|string|min:6|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('admins')->ignore($guard->user()->id),
                ],
            ];

            $this->validate($request, $rules);
            $admin = $guard->user();
            $admin->forceFill([
                'name' => $request['name'],
                'email' => $request['email'],
            ])->save();

            return response()->json(["message" => "Profile Changed"], 200);

        }

        return response()->json(["message" => "Forbidden"], 403);
    }
    public function updatePassword(Request $request)
    {
        $admin = $this->guard()->user();

        Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->after(function ($validator) use ($admin, $request) {
            if (!isset($request['current_password']) || !Hash::check($request['current_password'], $admin->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $this->guard()->user()->forceFill([
            'password' => Hash::make($request['password']),
        ])->save();
    }
    public function create(Request $request)
    {

        $rules = [
            'name' => 'required|string|min:6|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|confirmed|min:6',
        ];

        $this->validate($request, $rules);

        return Models\Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'is_super_admin' => $request['is_super_admin'],
            'is_admin' => 1,
            'password' => Hash::make($request['password']),
        ]);
    }
    public function show(Models\Admin $user)
    {
        $guard = $this->guard();
        if ($guard->user()) {
            return $user;
        }

        return response()->json(["message" => "Forbidden"], 403);
    }
    public function delete($user_id)
    {
        if (Auth::guard('admin')->user()) {
            $user = Models\Admin::find($user_id);
            $user->delete();
            return response()->json(["Status" => "SUCCESS", "message" => "User Deleted"], 200);

        }

        return response()->json(["message" => "Forbidden"], 403);
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
