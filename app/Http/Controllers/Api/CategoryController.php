<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Category::get();

        return response()->json([
            "status" => 200,
            "message" => "Category List",
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
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $new_category = new Category();
        $new_category->name = $request->name;
        $new_category->file_path = imageUpload($request->image, 'category');
        $new_category->save();

        return response()->json([
            "status" => 200,
            "message" => "Category added successfully",
            "data" => $new_category,
        ]);

    }
}
