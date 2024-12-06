<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Traits\DatabaseOperationsTrait;
use Exception;

class RoomController extends Controller
{
    use DatabaseOperationsTrait;
    public function index(Room $room) {
        $rooms = $this->getRecords($room);
        return view('room.index',compact('rooms'));
    }

    public function view(Room $room,$id) {
        $room = $this->getRecord($room,$id);
        if (!empty($room)) {
            dd($room);
        } else {
            abort(404);
        }
        
    }

    public function store(Request $request,Room $room) {
        $request->validate([
            'name'      =>      'required|string|max:255',
            'limit'     =>      'required|integer|max:10|min:2'
        ]);
        
        try {
            if ($this->storeRecord($room,$request->only('name','limit'))) {
                return redirect()->route('rooms')->with(['success' => 'Room Created Successfully']);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
