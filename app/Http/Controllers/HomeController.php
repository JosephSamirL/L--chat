<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\User;
use Auth;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index($num)

    {
        $message = Message::All();
        $message = Room::findOrFail($num)->Messages;
        $roomName = Room::findOrFail($num)->name;
        $private = Room::findOrFail($num)->public;
        $users = User::All();
        $room = Room::findOrFail($num);
        $InRoom = [];
        foreach ($room->users as $user) {
            if ($room->users->contains("id", $user->id)) {
                array_push($InRoom, $user->id);

            }
        }

        return view('home', array("message" => $message,
        "num"=>$num,
            "name"=>$roomName,
            "room"=>$room,
            "private" =>$private,
            "users" => $users,
        ));
    }
    public function create(Request $request)
    {

        $inp = $request->get('message');
        $room = $request->get('room');
        $message = new Message();
        $message->user_id = Auth::User()->id;
        $message->room_id = $room;
        $message->text = $inp;
        $message->file="";
        $message->save();



    }
}
