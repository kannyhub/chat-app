<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\DatabaseOperationsTrait;

class RoomController extends Controller
{
    use DatabaseOperationsTrait;
    public function index(Room $room) {
        $rooms = $this->getRecords($room);
        return view('room.index',compact('rooms'));
    }

    public function view(Room $room,$id) {
        $room = Room::find($id); 
        if (!empty($room)) {
            $room->attendee()->syncWithoutDetaching(Auth::user()->id);
            $room = Room::with('admin')->with('attendee')->find($id);
            return view('room.room',compact('room'));   
        }
        abort(404);
    }

    public function store(Request $request,Room $room) {
        $request->validate([
            'name'      =>      'required|string|max:255',
            'limit'     =>      'required|integer|max:10|min:2'
        ]);

        $data = $request->only('name','limit');
        $data = array_merge($data,['user_id' => Auth::user()->id]);

        try {
            if ($this->storeRecord($room,$data)) {
                return redirect()->route('rooms')->with(['success' => 'Room Created Successfully']);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
