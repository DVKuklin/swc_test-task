<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PagesController extends Controller
{
    public function index() {
        // return view('home');
        $first_event = Event::first();
        return redirect('/events/'.$first_event->id);
    }
}
