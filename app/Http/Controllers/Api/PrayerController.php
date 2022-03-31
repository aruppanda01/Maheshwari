<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Prayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;

class PrayerController extends BaseController
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Prayer::latest()->get();

        return response()->json([
            "status" => 200,
            "message" => "Prayer List",
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
            'file_name' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $new_prayer = new Prayer();
        $new_prayer->file_path = imageUpload($request->file_name, 'prayer');
        $new_prayer->save();

        return response()->json([
            "status" => 200,
            "message" => "Prayer audio added successfully",
            "data" => $new_prayer,
        ]);

    }
}
