<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models;
use App\Traits\CompanyMembershipHandler;
use Auth;
use Hash;
use Illuminate\Http\Request;
use ImageResize;
use Storage;

class ProfileController extends Controller
{
    use CompanyMembershipHandler;

    public function show()
    {

        $company = Auth::guard('company')->user();
        $this->checkMembershipStatus($company->id);
        $current_package = $this->getCurrentPackage($company->id);
        $current_membership = Models\MembershipActive::companyId($company->id)->first();
        if (!$current_package && $current_membership) {
            $current_membership->delete();
            $company->respond_unlimited = 0;
            $company->save();
        }
        if ($current_package) {
            $this->updateMembershipActive($current_membership, $current_package, $company->id);
            $company->respond_unlimited = $current_package->respond_quota == -1 ? 1 : 0;
            $company->save();
        }

        $this->checkReservedQuota($company->id);

        $data['company'] = Models\Company::where('id', $company->id)->with('business_category')->first();

        $data['business_category'] = Models\BusinessCategory::get();

        // return $data;
        return view('pages.company-dashboard', compact("data"));

    }
    public function updateProfile(Request $request)
    {
        $rules = [
            'profile' => 'nullable|string',
            'website' => 'nullable|string',
            'business_category_id' => 'required|numeric',
            'facebook_url' => 'nullable|string',
            'twitter_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
        ];
        $this->validate($request, $rules);

        $company = Auth::guard('company')->user();
        $company->profile = $request->profile;
        $company->website = $request->website;
        $company->business_category_id = $request->business_category_id;
        $company->facebook_url = $request->facebook_url;
        $company->twitter_url = $request->twitter_url;
        $company->linkedin_url = $request->linkedin_url;
        $company->instagram_url = $request->instagram_url;
        $company->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Data Updated'], 200);
        // $company_avatar = $request->file('itemFiles')->store("public/company/photo");
        // $company->avatar = pathinfo($company_avatar)['basename'];

    }
    public function updateProfileImage(Request $request)
    {

        $rules = [
            'file' => 'required|mimes:jpg,jpeg,png',
        ];
        $this->validate($request, $rules);

        $company = Auth::guard('company')->user();

        $path = 'public/company';
        $request->file('file')->store($path);
        $hashName = $request->file('file')->hashName();

        $img128 = ImageResize::make($request->file('file'));
        $img128->resize(128, 128, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path('app/' . $path . '/tmb128-' . $hashName));

        $this->deleteProfileImage();

        $company->avatar = $hashName;
        $company->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Image Updated', 'data' => $hashName], 200);
    }
    public function deleteProfileImage()
    {
        $company = Auth::guard('company')->user();
        Storage::delete("public/company/{$company->avatar}");
        Storage::delete("public/company/tmb128-{$company->avatar}");
        $company->avatar = null;
        $company->save();
        return response()->json(['status' => 'success', 'message' => 'Profile Image Deleted'], 200);

# code...
    }
    public function updatePassword(Request $request)
    {

        $rules = [
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ];
        $this->validate($request, $rules);

        $user = Auth::guard('company')->user();
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
