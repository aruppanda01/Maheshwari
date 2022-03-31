<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Document::latest()->get();

        return response()->json([
            "status" => 200,
            "message" => "Document List",
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
            'file_name' => 'required|mimes:pdf',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $new_document = new Document();
        $new_document->file_path = imageUpload($request->file_name, 'document');
        $new_document->save();

        return response()->json([
            "status" => 200,
            "message" => "Document added successfully",
            "data" => $new_document,
        ]);

    }
}
