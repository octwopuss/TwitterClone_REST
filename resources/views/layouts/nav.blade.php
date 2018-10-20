<nav class="navbar navbar-expand-lg  navbar-light bg-light">
            <a class="navbar-brand" href="#">Bagi Momen <i class="fa fa-heart"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>    
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('dashboard') }}"> <span class="fa fa-user"></span>  {{ Auth::guard('users')->user()->name }} </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"><span class="fa fa-power-off"></span> Logout</a>
                  </li>
              </ul>
          </div>     
        </nav>
        <div class="container-fluid">
          <div class="row">
            <nav class="col-sm-3 col-md-3 hidden-xs-down bg-faded sidebar">
              <form id="upload_form" action="post" enctype="multipart/form-data">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <br>
                <div class="form-group">                  
                  <h3>Description</h3>
                  <textarea class="form-control" rows="4" name="description" id="description"></textarea>                  
                  <label for="upload_image" class="input-group-append btn btn-primary">upload image</label>                  
                  <input type="file" id="upload_image" name="upload_image">
                  <input class="form-control" type="text" name="tags" data-role="tagsinput" placeholder="tags" id="tags">
                </div>
                <button type="submit" class="btn btn-success" >Post!</button>
              </form>
            </nav>     