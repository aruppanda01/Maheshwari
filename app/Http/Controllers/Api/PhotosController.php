<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (!$id) {
            return $this->sendError('Validation Error.','Please provide category id');
        }

        $category_existence = Category::find($id);
        if ($category_existence) {
            $photo = Photo::where('category_id',$id)->get();

            return response()->json([
                "status" => 200,
                "message" => "Photo List",
                "data" => $photo,
            ]);
        }else{
            return $this->sendError('Category id Error.', 'This category does not exist');
        }
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
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category_existence = Category::find($request->category_id);
        if ($category_existence) {
            $photo = new Photo();
            $photo->category_id = $request->category_id;
            $photo->file_path = imageUpload($request->image, 'photos');
            $photo->save();
    
            return response()->json([
                "status" => 200,
                "message" => "Photo added successfully",
                "data" => $photo,
            ]);
        } else {
            return $this->sendError('Category id Error.', 'This category does not exist');
        }
        


    }
}
