<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return response()->json([
            "status" => 200,
            "message" => "Updates List",
            "data" => $updates,
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $imageName = imageUpload($request->image, 'updates');

        $Update = new Update();
        $Update->file_path = $imageName;
        $Update->save();

        return response()->json([
            "status" => 200,
            "data" => $Update,
            "message" => "Image successfully updated",
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
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {


        $teamId = $request->id;

        $team = Team::where('id', $teamId)->update([
            'status' => $request->status,
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
        $team = Team::find($id);
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'userId' => 'required',
            'name' => 'required',
            'email' => 'required|unique:teams',
            'phone' => 'required|digits:10|integer|unique:teams',
        ]);

        // dd($request->all());
        $team = Team::find($id);

        $team->update([
            'userId' => $request->userId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return response()->json([
            "status" => 200,
            "data" => $team,
            "message" => "Team Update Successfull",
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
        Team::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Team Delete Successfull",
        ]);
    }
}