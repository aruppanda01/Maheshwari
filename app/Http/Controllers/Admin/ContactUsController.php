<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_us = ContactUs::latest()->get();
        return view('admin.contact_us.index',compact('contact_us'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact_us.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'facebook_link' => 'nullable|max:255',
            'twitter_link' => 'nullable|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'pin_code' => 'required|digits:6',
            'mobile_no' => 'required|digits:10'
        ]);

        $contact_us = new ContactUs();
        $contact_us->fb_link = $request->facebook_link;
        $contact_us->twitter_link = $request->facebook_link;
        $contact_us->mobile_no = $request->mobile_no;
        $contact_us->address = $request->address;
        $contact_us->city = $request->city;
        $contact_us->pin_code = $request->pin_code;
        $contact_us->save();

        return $this->responseRedirect('admin.contact.index', 'Contact us has been added successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $contact_details = ContactUs::find($id);
        // return view('admin.contact_us.edit',compact('contact_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact_details = ContactUs::find($id);
        return view('admin.contact_us.edit',compact('contact_details'));
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
        $this->validate($request,[
            'facebook_link' => 'nullable|max:255',
            'twitter_link' => 'nullable|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'pin_code' => 'required|digits:6',
            'mobile_no' => 'required|digits:10'
        ]);

        $contact_us = ContactUs::find($id);
        $contact_us->fb_link = $request->facebook_link;
        $contact_us->twitter_link = $request->twitter_link;
        $contact_us->mobile_no = $request->mobile_no;
        $contact_us->address = $request->address;
        $contact_us->city = $request->city;
        $contact_us->pin_code = $request->pin_code;
        $contact_us->save();

        return $this->responseRedirect('admin.contact.index', 'Contact us has been added successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
