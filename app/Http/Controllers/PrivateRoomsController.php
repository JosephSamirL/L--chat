<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Auth;
use App\Models\Message;
use Illuminate\Http\Request;

class PrivateRoomsController extends Controller
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
    public function index($id)

    {

        return view('private',array("num"=>$id));
    }

}
