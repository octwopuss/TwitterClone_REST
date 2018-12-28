@extends('index')

@section('style')		
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('importantPart')

@php
    use App\User;
    // user_id_two itu follows
    // user_id_one itu follower 
    $currentPath = Route::currentRouteName();
    $results = ($currentPath == 'followers') ? $followers : $follows;        
@endphp

    @foreach($results as $result)
    @php
        if($currentPath == 'followers'){
            $user = User::find($result->user_id_one);            
        }else{
            $user = User::find($result->user_id_two);
        }
    @endphp
    <center>
        <div class="card text-white border-dark mb-3" style="height: 15rem; max-width: 30rem; text-align: left;">
            <div class="card-header right"><p class="right hitFollow follow-box badge badge-info"><span class="follow-text" style="font-size: 1.54em;"><a href="#" style="text-decoration:none; color: white; ">{{$user->username}}</a></span></p>
            </div>        
            <div style="display: flex;">
                <div>
                    <img src="{{url('storage/'.$user->userdetail->profilepic)}}" class="center rounded-circle" style="height: 130px; width: 130px; margin-left: 5%; margin-top: 5%;">
                </div>
                <div>
                    <p class="card-text">{{$user->userdetail->biograph}}</p>  
                </div>
            </div>                  
        </div>
    </center>
    @endforeach

@endsection

@section('mainjs')


@endsection