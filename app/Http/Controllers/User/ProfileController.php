<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
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
        $user = Auth::guard('web')->user();
        $user->profile = $request->profile;
        $user->name = $request->name;

        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Data Updated'], 200);

    }
    public function updateProfileImage(Request $request)
    {
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

# code...
    }
}
