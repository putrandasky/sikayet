<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show()
    {
        $user = Auth::guard('company')->user();
        $data['review']['total'] = Models\Review::companyId($user->id)->count();
        $data['review']['answered'] = Models\CompanyRespond::companyId($user->id)->count();

        $data['review']['unanswered'] = $data['review']['total'] - $data['review']['answered'];
        $data['reviews'] = Models\Review::companyId($user->id)->with([
            'user' => function ($query) {
                $query->select(['id', 'name']);
            },
            'company_respond.company' => function ($query) {
                $query->select(['id', 'name']);

            },
            'review_type',
            'review_status'])->latest()->get();
        // $review = Models\Review::userId($user->id)
        return $data;

    }

    public function respond(Request $request)
    {
        $user = Auth::guard('company')->user();
        $respond = new Models\CompanyRespond();
        $respond->description = $request->respond;
        $respond->review_id = $request->review_id;
        $respond->company_id = $user->id;
        $respond->save();
        $company_respond = Models\CompanyRespond::where('id', $respond->id)
            ->with([
                'company' => function ($query) {
                    $query->select(['id', 'name']);
                }])->first();

        return response()->json(['status' => 'success', 'message' => 'A review has been responded', 'data' => $company_respond], 200);
    }
    public function report($review_id)
    {
        $company = Auth::guard('company')->user();
        $review = Models\Review::where([
            'id' => $review_id,
            'company_id' => $company->id,
        ])->first();
        $review->reported = 1;
        $review->save();
        return response()->json(['status' => 'success', 'message' => 'A review has been reported'], 200);

    }
}
