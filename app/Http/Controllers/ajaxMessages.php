<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ajaxMessages extends Controller
{
    public function fetch()
    {
    $messages = Message::all();


        return response()->json($messages, 200);
    }
    public function fetchUser()
    {
        $user = User::all();
        return response()->json($user, 200);
    }
    public function fetchRoom()
    {
        $rooms = Room::all();
        return response()->json($rooms, 200);
    }
    public function removeMessage(Request $request)
    {
        $id = $request->get('id');


        $message = Message::findOrFail($id);

        if ( $request->ajax() ) {
            $message->delete( $request->all() );

            return response(['msg' => 'Product deleted', 'status' => 'success']);
        }
        return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);

    }

    public function removeRoom(Request $request)
    {
        $id = $request->get('id');


        $room = Room::findOrFail($id);

        if ( $request->ajax() ) {
            $room->delete( $request->all() );

            return response(['msg' => 'Product deleted', 'status' => 'success']);
        }
        return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg'
        ]);
        if($request->hasfile('filenames'))
        {
            $name = $request->filenames->getClientOriginalName();

            $request->filenames->storeAs("public/uploads",$name);





                $data = $name;
                $file= new Message();
                $room = $request->get('room');
                $file->user_id = Auth::User()->id;
                $file->room_id = $room;
                $file->text = "file";
                $file->file= "/storage/uploads/" . $data;

                $file->save();


        }





        return back()->with('success', 'Your files has been send successfully');
    }

}
