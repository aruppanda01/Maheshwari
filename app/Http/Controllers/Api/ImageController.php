<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;

class ImageController extends BaseController
{
    function randomGenerator()
    {
        return uniqid() . '' . date('ymdhis') . '' . uniqid();
    }

    function imageUpload($image, $folder = 'image')
    {
        $random = $this->randomGenerator();
        $image->move('upload/' . $folder . '/', $random . '.' . $image->getClientOriginalExtension());
        $imageurl = 'upload/' . $folder . '/' . $random . '.' . $image->getClientOriginalExtension();
        // dd($imageurl);
        return $imageurl;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $imageUrl =  $this->imageUpload($request->image, 'image');
        return response()->json([
            "status" => 200,
            "message" => "Image upload successful",
            "data" => $imageUrl,
        ]);
    }
}
