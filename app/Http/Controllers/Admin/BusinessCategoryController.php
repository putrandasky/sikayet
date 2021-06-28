<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    public function index()
    {
        $data = Models\BusinessCategory::withCount('companies')->orderBy('name')->get();
        return $data;
    }
    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required|string|min:3',
        ];
        $this->validate($request, $rules);

        $data = new Models\BusinessCategory();
        $data->name = $request->category_name;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'New Business Category Stored', 'data' => $data], 200);
    }
    public function update(Request $request)
    {
        $rules = [
            'category_name' => 'required|string|min:3',
        ];
        $this->validate($request, $rules);

        $data = Models\BusinessCategory::id($request->category_id)->first();
        $data->name = $request->category_name;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'Business Category Updated'], 200);
    }
    public function delete($category_id)
    {
        $data = Models\BusinessCategory::id($category_id)->with('companies')->first();

        foreach ($data->companies as $company) {
            $company->business_category_id = 0;
            $company->save();
        }
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'Business Category Deleted'], 200);

    }
}
