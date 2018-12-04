@extends('index')

@section('style')		
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('importantPart')

@foreach($result as $res)
<div style="padding-left: 35%;">
    <div class="card text-white border-dark mb-3" style="max-width: 40rem; height: 15rem; display: inline-block;">
        <div class="card-header right"><p class="right hitFollow follow-box badge badge-info"><span class="follow-text" style="font-size: 1.54em;">FOLLOW</span></p></div>        
        <div class="row">
            <div class="col-sm-2" style="margin-top: 1%: margin-left: 5%;">
                <img src="{{asset('img/pepe.png')}}" class="center rounded-circle" style="height: 130px; width: 130px; margin-left: 5%; margin-top: 5%;">
            </div>
            <div class="col-sm-10">
                <div class="card-body" style="padding-left: 10%;">
                    <h4 class="card-title"><a href="{{route('showFriend', $res->username)}}" style="text-decoration:none;">{{$res->name}}</a></h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endforeach

@endsection

@section('mainjs')


@endsection