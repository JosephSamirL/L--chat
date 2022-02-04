@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




                        @foreach ($message as $message)
                            @if ($message->file == "")
                                <div style={{"background: red"}} data-id={{$message->id}} class="{{$message->user_id == Auth::User()->id?"message-container":"message-container other"}}">
                                    <p><span class="{{$message->user_id == Auth::User()->id?"message-sender you":"message-sender"}}">{{$message->user_id == Auth::User()->id?"you":\App\Models\User::find($message->user_id)->name}}</span> {{ $message->text }}</p>

                                    <div class="deleteTheProduct">

                                        <form method ='POST' class = 'formDeleteProduct' action = '/destroy' >
                                            @csrf
                                            <input name="id" type="hidden" value={{$message->id}} >
                                            <button type="button">
                                                <svg width="6" height="29" viewBox="0 0 6 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#ADB5BD"/>
                                                    <circle cx="2.5" cy="14" r="2.5" fill="#ADB5BD"/>
                                                    <circle cx="2.5" cy="25" r="2.5" fill="#ADB5BD"/>
                                                </svg>


                                            </button>
                                            <button style="display: none" type="submit">Remove</button>

                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="background: unset!important;" data-id={{$message->id}} class="{{$message->user_id == Auth::User()->id?"message-container":"message-container other"}}">
                                    <p style="position: absolute; "><span class="{{$message->user_id == Auth::User()->id?"message-sender you":"message-sender"}}">{{$message->user_id == Auth::User()->id?"you":\App\Models\User::find($message->user_id)->name}}</span> </p>
                                     <img src="{{ asset($message->file) }}"/>
                                    <div style=" position: absolute; left: calc(100% - 68px); top: 8px;" class="deleteTheProduct">

                                        <form method ='POST' class = 'formDeleteProduct' action = '/destroy' >
                                            @csrf
                                            <input name="id" type="hidden" value={{$message->id}} >
                                            <button type="button">
                                                <svg width="6" height="29" viewBox="0 0 6 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#ADB5BD"/>
                                                    <circle cx="2.5" cy="14" r="2.5" fill="#ADB5BD"/>
                                                    <circle cx="2.5" cy="25" r="2.5" fill="#ADB5BD"/>
                                                </svg>


                                            </button>
                                            <button style="display: none" type="submit">Remove</button>

                                        </form>
                                    </div>
                                </div>
                            @endif



                        @endforeach

                        <form id="sub" method="POST" action="/home">
                            @csrf
                            <input style="display: none" name="room" value="{{$num}}">
                            <input name="message" placeholder="Message"/>
                            <button type="submit">Submit</button>

                        </form>
                        <div class="image-upload">
                            <form action="/imageupload" id="attatch" method="post" enctype="multipart/form-data"   >
                                @csrf

                                <input type="hidden" name="room" value="{{$num}}">

                                <input id="" type="file" name="filenames">

                                <button type="submit">submit</button>
                            </form>

                        </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
