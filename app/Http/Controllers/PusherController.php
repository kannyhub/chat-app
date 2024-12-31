<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function index() {
        return view(view:'index');
    }

    public function broadcast(Request $request) {
        // Ensure the 'message' key exists in the request
        $message = $request->input('message'); // 'input' is preferred over 'get'
        $room = $request->input('room');
    
        // Broadcast the event
        broadcast(new PusherBroadcast($message,Auth::user(),$room))->toOthers();
    
        // Return the view with the message
        return view('broadcast', ['message' => $message]);
    }

    // public function receive(Request $request) {
    //     // Retrieve the 'message' key from the request
    //     $message = $request->input('message'); // 'input' is preferred over 'get'
    
    //     // Return the view with the message
    //     return view('receive', ['message' => $message]);
    // }
}
