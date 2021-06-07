<?php

namespace App\Http\Controllers\Website;

use App;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data = array();
        foreach (range('A', 'Z') as $char) {
            $data[$char] = [];
        }

        $companies = App\Models\Company::get();
        foreach ($companies as $company) {
            $firstletter = strtoupper(substr($company->name, 0, 1));
            $item['name'] = $company->name;
            $item['slug'] = $company->slug;

            array_push($data[$firstletter], $item);
        }

        // return $data;
        return view('pages.company-brands', compact("data"));
    }
    public function indexByFirstletter($firstletter)
    {
        $data = array();
        $data[$firstletter] = [];

        $companies = App\Models\Company::get();
        foreach ($companies as $company) {
            $getfirstletter = strtoupper(substr($company->name, 0, 1));
            if ($getfirstletter != $firstletter) {
                continue;
            }
            $item['name'] = $company->name;
            $item['slug'] = $company->slug;
            array_push($data[$getfirstletter], $item);
        }

        // return $data;
        return view('pages.company-brands', compact("data"));
    }
}
