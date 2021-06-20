<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        // $datas = Models\Editor::get(['key']);
        // for ($i = 24; $i < 35; $i++) {
        //     $data = Models\Editor::where('id', $i)->first();
        //     $data->key = str_replace('-', '_', $data->key);
        //     $data->save();
        //     # code...
        // }
        $reviews = Models\Review::get();
        for ($i = 0; $i < count($reviews); $i++) {
            $review = Models\Review::id($reviews[$i]->id)->first();
            $review->slug = md5($review->id . $review->user_id . $review->company_id);
            $review->save();
        }
        // return $datas;
    }
}
