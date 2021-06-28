<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use ImageResize;
use Storage;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $user = Auth::guard('web')->user();
        // $review = Models\Review::userId($user->id)
        return view('pages.user-dashboard', compact('user'));

    }
    public function updateProfile(Request $request)
    {
        $rules = [
            'profile' => 'required|string',
            'name' => 'required|string',
        ];
        $this->validate($request, $rules);

        $user = Auth::guard('web')->user();
        $user->profile = $request->profile;
        $user->name = $request->name;

        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Data Updated'], 200);

    }
    public function updateProfileImage(Request $request)
    {

        $rules = [
            'file' => 'required|mimes:jpg,jpeg,png',
        ];
        $this->validate($request, $rules);

        $user = Auth::guard('web')->user();

        $path = 'public/user';
        $request->file('file')->store($path);
        $hashName = $request->file('file')->hashName();

        $img128 = ImageResize::make($request->file('file'));
        $img128->resize(128, 128, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path('app/' . $path . '/tmb128-' . $hashName));

        $this->deleteProfileImage();

        $user->avatar = $hashName;
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Image Updated', 'data' => $hashName], 200);
    }
    public function deleteProfileImage()
    {
        $user = Auth::guard('web')->user();
        Storage::delete("public/user/{$user->avatar}");
        Storage::delete("public/user/tmb128-{$user->avatar}");
        $user->avatar = null;
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Image Deleted'], 200);

    }

    public function updatePassword(Request $request)
    {

        $rules = [
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ];
        $this->validate($request, $rules);

        $user = Auth::guard('web')->user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Your Password Changed'], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The given data was invalid.',
                'errors' => ['current_password' => ['Your Input Current Password is Not Match From Database']]], 403);

        }

    }
}
