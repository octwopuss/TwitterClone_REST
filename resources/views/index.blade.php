<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Photo Sharing App</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/tagsinput.css')}}">
        <style>
        #upload_image {
          opacity: 0;
          position: absolute;
          z-index: -1;
        }
        
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- START NAVBAR -->
          @include('layouts.nav')           
            <!-- END NAVBAR  -->
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
            <div class="col-md-5">
              <br><br>              
              <div class="loading">
                <center> <img src="{{asset('/img/loading2.gif')}}" style="width: 100px; height: 100px;"></center>                
              </div>
              <div class="moments">
                                          
              </div>
            </div>              
            <div class="col-md-3">
              <br><br>
             <div class="container-fluid">
               <h2>Momen terpopuler</h2>
               <div class="popularTags">                 
               </div>               
             </div>
            </div>
          </div>
        </div>

        <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
        <script src="https://bootswatch.com/_vendor/popper.js/dist/umd/popper.min.js"></script>
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://bootswatch.com/_assets/js/custom.js"></script>
        <script type="text/javascript" src="{{asset('js/tagsinput.js')}}"></script>
        @include('scripts.main')
    </body>
</html>