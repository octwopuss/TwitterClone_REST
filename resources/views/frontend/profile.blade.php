@extends('index')

@section('importantPart')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row" style="margin-top: 5%; ">
    <div class="col-md-3"></div>
    <div class="col-md-5" style="background: #ffff;border-radius: 10px;">
        <form method="POST" action="{{route('storeProfile', $id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
            <label for="Bio" ><h3 style="color: black;">Bio</h3></label>
            <textarea class="form-control" id="Bio" name="bio" rows="3"></textarea>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="profilepic">
                <label class="custom-file-label" for="inputGroupFile02">Choose File</label>
            </div>
            <div class="form-group">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection