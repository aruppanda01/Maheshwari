<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoverningBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;

class GoverningController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = GoverningBody::get();

        return response()->json([
            "status" => 200,
            "message" => "Governing Body List",
            "data" => $events,
        ]);
    }
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'designation' => 'required|max:255',
            'email' => 'required|unique:governing_bodies',
            'mobile_no' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $new_governing = new GoverningBody();
        $new_governing->name = $request->name;
        $new_governing->file_path = imageUpload($request->image, 'governing_bodies');
        $new_governing->designation = $request->designation;
        $new_governing->email = $request->email;
        $new_governing->mobile_no = $request->mobile_no;
        $new_governing->tearms_start_year = $request->start_year;
        $new_governing->tearms_end_year = $request->end_year;
        $new_governing->save();

        return response()->json([
            "status" => 200,
            "message" => "Governing added successfully",
            "data" => $new_governing,
        ]);

    }
}
