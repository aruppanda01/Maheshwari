<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('admin.photos.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.photos.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $photo = new Photo();
        $photo->category_id = $request->category;
        $photo->file_path = imageUpload($request->image, 'photos');
        $photo->save();

        return $this->responseRedirect('admin.photo.index', 'Photo has been added successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['categories'] = Category::latest()->get();
        $data['photo_details'] = Photo::find($id);
        return view('admin.photos.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $photo = Photo::find($id);
        $photo->category_id = $request->category;
        if ($request->image) {
            $photo->file_path = imageUpload($request->image, 'photos');
        }else{
            $photo->file_path = $photo->file_path;
        }
        
        $photo->save();

        return $this->responseRedirect('admin.photo.index', 'Photo has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Photo::find($id)->delete();
        return $this->responseRedirect('admin.photo.index', 'Photo has been deleted successfully', 'success', false, false);
    }
}
