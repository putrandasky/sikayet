<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;

class ContactController extends Controller
{
    public function showContact()
    {
        $contact = Models\Contact::get();
        return $contact;

    }
}
