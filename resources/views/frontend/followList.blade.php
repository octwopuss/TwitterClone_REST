@extends('index')

@section('style')		
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('importantPart')

@php
    $currentPath = Route::currentRouteName();
    $results = ($currentPath == 'followers') ? $followers : $follows;
@endphp

    @foreach($results as $result)
    <center>
        <div class="card text-white border-dark mb-3" style="height: 15rem; max-width: 30rem; text-align: left;">
            <div class="card-header right"><p class="right hitFollow follow-box badge badge-info"><span class="follow-text" style="font-size: 1.54em;"><a href="#" style="text-decoration:none; color: white; ">Nama</a></span></p>
            </div>        
            <div style="display: flex;">
                <div>
                    <img src="" class="center rounded-circle" style="height: 130px; width: 130px; margin-left: 5%; margin-top: 5%;">
                </div>
                <div>
                    <p class="card-text"></p>  
                </div>
            </div>                  
        </div>
    </center>
    @endforeach

@endsection

@section('mainjs')


@endsection