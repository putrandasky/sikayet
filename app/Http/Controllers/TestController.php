<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $datas = Models\Editor::get(['key']);
        // for ($i = 24; $i < 35; $i++) {
        //     $data = Models\Editor::where('id', $i)->first();
        //     $data->key = str_replace('-', '_', $data->key);
        //     $data->save();
        //     # code...
        // }
        return $datas;
    }
}
