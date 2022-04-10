<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $new_category = new Category();
        $new_category->name = $request->name;
        $new_category->file_path = imageUpload($request->image, 'category');
        $new_category->save();
        return $this->responseRedirect('admin.category.index', 'Category has been created successfully', 'success', false, false);
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
        $category_details = Category::find($id);
        return view('admin.category.edit',compact('category_details'));
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
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        if ($request->image) {
            $category->file_path = imageUpload($request->image, 'category');
        }else{
            $category->file_path = $category->file_path;
        }
        
        $category->save();
        return $this->responseRedirect('admin.category.index', 'Category has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return $this->responseRedirect('admin.category.index', 'Category has been deleted successfully', 'success', false, false);
    }
}
