<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GoverningBody;
use Illuminate\Http\Request;

class GoverningController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governors = GoverningBody::latest()->get();
        return view('admin.governing_bodies.index',compact('governors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.governing_bodies.add');
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
            'designation' => 'required|max:255',
            'email' => 'required|email|unique:governing_bodies',
            'mobile_no' => 'required|digits:10',
            'start_year' => 'required_with:end_year',
            'end_year' => 'required_with:start_year'
        ],[
            'start_year.required_with' => 'This field is required',
            'end_year.required_with' => 'This field is required',
        ]);

        $new_governing = new GoverningBody();
        $new_governing->name = $request->name;
        $new_governing->file_path = imageUpload($request->image, 'governing_bodies');
        $new_governing->designation = $request->designation;
        $new_governing->email = $request->email;
        $new_governing->mobile_no = $request->mobile_no;
        $new_governing->tearms_start_year = $request->start_year;
        $new_governing->tearms_end_year = $request->end_year;
        $new_governing->save();

        return $this->responseRedirect('admin.governor.index', 'Governing Body has been added successfully', 'success', false, false);
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
        $governor_details = GoverningBody::find($id);
        return view('admin.governing_bodies.edit',compact('governor_details'));
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
            'designation' => 'required|max:255',
            'email' => 'required|email',
            'mobile_no' => 'required|digits:10',
            'start_year' => 'required_with:end_year',
            'end_year' => 'required_with:start_year'
        ],[
            'start_year.required_with' => 'This field is required',
            'end_year.required_with' => 'This field is required',
        ]);

        $governing = GoverningBody::find($id);
        $governing->name = $request->name;
        $governing->file_path = imageUpload($request->image, 'governing_bodies');
        $governing->designation = $request->designation;
        $governing->email = $request->email;
        $governing->mobile_no = $request->mobile_no;
        $governing->tearms_start_year = $request->start_year;
        $governing->tearms_end_year = $request->end_year;
        $governing->save();

        return $this->responseRedirect('admin.governor.index', 'Governing Body has been update successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GoverningBody::find($id)->delete();
        return $this->responseRedirect('admin.governor.index', 'Governing Body has been update successfully', 'success', false, false);
    }
}
