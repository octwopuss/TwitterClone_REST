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