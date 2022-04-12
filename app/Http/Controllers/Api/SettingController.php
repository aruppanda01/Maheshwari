<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\FAQ;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function getTerms()
    {
        $terms = Setting::where('page_title','terms')->first();
        return response()->json([
            "status" => 200,
            "message" => "Terms and conditions",
            "data" => $terms,
        ]);
    }
    public function getPrivacy()
    {
        $privacy = Setting::where('page_title','privacy')->first();
        return response()->json([
            "status" => 200,
            "message" => "Privacy",
            "data" => $privacy,
        ]);
    }
    public function getFAQ()
    {
       $faq = FAQ::latest()->get();
       return response()->json([
            "status" => 200,
            "message" => "FAQs",
            "data" => $faq,
        ]);
    }

    public function getContact()
    {
        $contact = ContactUs::latest()->get();
        return response()->json([
            "status" => 200,
            "message" => "Contact us",
            "data" => $contact,
        ]);
    }
}
