@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">
                @if($private == 0)

                <div class="card-header"><span>{{ $name }}</span>

                <div id="dropdown">
                    <div class="card-dropdown-selected">
                        Add New Users
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                <path d="M895 3506 c-67 -29 -105 -105 -90 -183 6 -34 100 -131 843 -875 744 -743 841 -837 875 -843 94 -18 39 -66 949 843 909 909 861 855 843 949 -9 49 -69 109 -118 118 -94 18 -46 59 -875 -768 l-762 -762 -758 757 c-424 424 -769 762 -785 768 -38 14 -85 12 -122 -4z"/>
                            </g>
                        </svg>
                    </div>

                    <div class="card-dropdown-drop">
                        {{$room->users[0]->name}}

                              @foreach ($users as $user)

                                  <div class="card-dropdown-drop-user">{{$user->name}} {{$num}}</div>
                        @endforeach
                    </div>
                </div>

                </div>
                @else
                    <div class="card-header"><span>{{ $name }}</span></div>
                @endif
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
