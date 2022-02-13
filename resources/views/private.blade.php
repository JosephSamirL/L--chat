@extends('layouts.app')

@section('content')

    <div class="rooms_container">
        @foreach ($rooms as $room)

            @if($room->name)
                @if($room->public===0)
                <a class="rooms_link" href="/room/{{$room->id}}">
                    {{$room->name}}


                    {{--            {{mt_rand(1, 100)}}--}}
                    <form method ='POST' class = 'formDeleteProductRooms' action = '/destroyRoom' >
                        @csrf
                        <input name="id" type="hidden" value={{$room->id}} >

                        <button style="{{$room->user_id == Auth::User()->id?"display: block":"display: none"}}" type="submit">Remove</button>

                    </form>
                </a>
                @endif
                @else
                Sorry you are not a part of any private rooms but you can create one below
            @endif
        @endforeach
    </div>
    <div class="rooms-input_container">
        <form id="subroomprivate" method="POST" action="/roomyprivate">
            @csrf

            <input name="Room" placeholder="Create a New Private Room"/>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
