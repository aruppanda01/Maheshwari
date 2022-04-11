<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getTerms()
    {
        $terms = Setting::where('page_title','terms')->latest();
        return view('admin.terms.index',compact('terms'));
    }

    public function editTerms(Req)
    {
        # code...
    }
}
