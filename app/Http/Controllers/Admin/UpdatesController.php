<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Update;
use Illuminate\Http\Request;

class UpdatesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $updates = Update::latest()->get();
        return view('admin.updates.index',compact('updates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.updates.add');
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $photo = new Update();
        $photo->file_path = imageUpload($request->image, 'updates');
        $photo->save();

        return $this->responseRedirect('admin.update.index', 'Update has been added successfully', 'success', false, false);
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
        $updates_details = Update::find($id);
        return view('admin.updates.edit',compact('updates_details'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $updates = Update::find($id);

        if ($request->image) {
            $updates->file_path = imageUpload($request->image, 'updates');
        }
        else{
            $updates->file_path = $updates->file_path;
        }
        
        $updates->save();

        return $this->responseRedirect('admin.update.index', 'Updates has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Update::find($id)->delete();
        return $this->responseRedirect('admin.update.index', 'Updates has been deleted successfully', 'success', false, false);
    }
}
