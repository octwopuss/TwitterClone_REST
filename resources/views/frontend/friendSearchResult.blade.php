@extends('index')

@section('style')		
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('importantPart')

@foreach($result as $res)
<center>
    <div class="card text-white border-dark mb-3" style="height: 15rem; max-width: 30rem; text-align: left;">
        <div class="card-header right"><p class="right hitFollow follow-box badge badge-info"><span class="follow-text" style="font-size: 1.54em;"><a href="{{route('showFriend', $res->username)}}" style="text-decoration:none; color: white; ">{{$res->name}}</a></span></p>
        </div>        
        <div style="display: flex;">
            <div>
                <img src="{{asset('storage/'.$res->userdetail->profilepic)}}" class="center rounded-circle" style="height: 130px; width: 130px; margin-left: 5%; margin-top: 5%;">
            </div>
            <div>
                <p class="card-text">{{$res->userdetail->biograph}} </p>  
            </div>
        </div>            
        <!-- <div class="row">
            <div class="col-sm-2" style="margin-top: 1%: margin-left: 5%;">
                <img src="{{asset('storage/'.$res->userdetail->profilepic)}}" class="center rounded-circle" style="height: 130px; width: 130px; margin-left: 5%; margin-top: 5%;">
            </div>
            <div class="col-sm-10">
                <div class="card-body" style="padding-left: 10%;">                  
                    <p class="card-text">{{$res->userdetail->biograph}} </p>
                </div>
            </div>
        </div> -->
       
    </div>
</center>
@endforeach

@endsection

@section('mainjs')


@endsection