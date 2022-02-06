<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\User_room;
use Auth;
use App\Models\Message;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $message = Message::All();
        $rooms = Room::All();
        return view('rooms', array("rooms" => $rooms));
    }
    public function fetchRoom()
    {
        $roomss = Room::all();
        return response()->json($roomss, 200);
    }
    public function create(Request $request)
    {
        $inp = $request->get('Room');

        $Room = new Room();

//        $Room->user_id = Auth::User()->id;
        $Room->name = $inp;

        $Room->save();
        $test = new User_room();
        $test->user_id = Auth::User()->id;
        $test->room_id = $Room->id;
        $test->save();





    }
}
