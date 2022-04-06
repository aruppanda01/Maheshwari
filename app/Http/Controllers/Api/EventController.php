<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Event;
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
        $events = Event::get();

        $data = [];
        foreach ($events as $eventKey => $eventValue) {
            $data[] = [
                'id' => $eventValue->id,
                'title' => $eventValue->title,
                'start_date' => $eventValue->start_date,
                'pretty_start_date' => date('jS F, Y', strtotime($eventValue->start_date)),
                'end_date' => $eventValue->end_date,
                'pretty_end_date' => date('jS F, Y', strtotime($eventValue->end_date)),
                'description' => $eventValue->description,
                'image' => $eventValue->image,
                'status' => $eventValue->status,
                'created_at' => $eventValue->created_at,
                'updated_at' => $eventValue->updated_at,
            ];
        }

        return response()->json([
            "status" => 200,
            "message" => "Event List",
            "data" => $data,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'title' => 'required|max:255',
            'start_date' =>  'required|date',
            'end_date' =>  'required|date',
            'description' =>  'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $new_event = new Event();
        $new_event->title = $request->title;
        $new_event->start_date = date('Y-m-d', strtotime($request->start_date));
        $new_event->end_date = date('Y-m-d', strtotime($request->end_date));
        $new_event->description = $request->description;
        $new_event->image = imageUpload($request->image, 'events');
        $new_event->save();

        return response()->json([
            "status" => 200,
            "message" => "Event added successfully",
            "data" => $new_event,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Event::where('id', $id)->get();

        return response()->json([
            "status" => 200,
            "message" => "Event Details",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $Update = Event::find($id);

        if($request->hasFile('image')){
            $imageName = imageUpload($request->image, 'updates');
        }else{
            $imageName = $Update->image;
        }
        $Update->image = $imageName;
        $Update->save();

        return response()->json([
            "status" => 200,
            "data" => $Update,
            "message" => "Image successfully updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}