@extends('layouts.app')

@section('content')
    <div class="rooms_container">
    @foreach ($rooms as $room)
        <a class="rooms_link" href="room/{{$room->id}}">
            {{$room->name}}

{{--            {{mt_rand(1, 100)}}--}}
            <form method ='POST' class = 'formDeleteProductRooms' action = '/destroyRoom' >
                @csrf
                <input name="id" type="hidden" value={{$room->id}} >

                <button style="{{$room->user_id == Auth::User()->id?"display: block":"display: none"}}" type="submit">Remove</button>

            </form>
        </a>
    @endforeach
    </div>
    <div class="rooms-input_container">
    <form id="subroom" method="POST" action="/roomy">
        @csrf

        <input name="Room" placeholder="Create a New Room"/>
        <button type="submit">Submit</button>
    </form>
    </div>
@endsection
