<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.add');
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
            'title' => 'required|max:255',
            'start_date' =>  'required|date',
            'end_date' =>  'required|date',
            'description' =>  'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $new_event = new Event();
        $new_event->title = $request->title;
        $new_event->start_date = date('Y-m-d', strtotime($request->start_date));
        $new_event->end_date = date('Y-m-d', strtotime($request->end_date));
        $new_event->description = $request->description;
        $new_event->image = imageUpload($request->image, 'events');
        $new_event->save();
        return $this->responseRedirect('admin.event.index', 'Event has been created successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event_details = Event::find($id);
        return view('admin.events.edit',compact('event_details'));
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
            'title' => 'required|max:255',
            'start_date' =>  'required|date',
            'end_date' =>  'required|date',
            'description' =>  'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);       
        $event = Event::find($id);

        if($request->hasFile('image')){
            $imageName = imageUpload($request->image, 'event');
        }else{
            $imageName = $event->image;
        }

        $event->title = $request->title;
        $event->start_date = date('Y-m-d', strtotime($request->start_date));
        $event->end_date = date('Y-m-d', strtotime($request->end_date));
        $event->description = $request->description;
        $event->image = $imageName;
        $event->save();
        return $this->responseRedirect('admin.event.index', 'Event update successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return $this->responseRedirect('admin.event.index', 'Event deleted successfully', 'success', false, false);
    }
}
