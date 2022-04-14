<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Forum;
use App\Models\GoverningBody;
use App\Models\Interest;
use App\Models\Photo;
use App\Models\Team;
use App\Models\Update;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (object)[];
        $data->totalUsers = User::count();
        $data->events = Event::count();
        $data->category = Category::count();
        $data->photos = Photo::count();
        $data->updates = Update::count();
        $data->governing_bodies = GoverningBody::count();

        return view('admin.dashboard', compact('data'));
    }
}