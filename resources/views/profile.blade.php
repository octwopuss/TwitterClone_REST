<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>User's profile</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

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
         <div class="container-fluid">
            <form name="addFriendForm"> 
              <meta name="csrf-token" content="{{ csrf_token() }}" />
              <button class="btn btn-primary" >add friend</button>
            </form>
          </div>
        </div>
        <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
        <script src="https://bootswatch.com/_vendor/popper.js/dist/umd/popper.min.js"></script>
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://bootswatch.com/_assets/js/custom.js"></script>    
        <script>
          const API_URL_CREATEFRIEND = '{{route('friend.create')}}';

          function switchId(userone, usertwo){
            var array = [];
            
              if(userone > usertwo){
                var temp =  userone;
                userone = usertwo;
                usertwo = temp;
                array.push(userone, usertwo);
              }
              array.push(userone, usertwo);
              var data = [array[0], array[1]];
              return data;
            }

          const addFriend = $("form[name='addFriendForm']").submit(function(event){
            event.preventDefault();
            var userMain = '{{Auth::guard('users')->user()->id}}';
            var userTarget = '{{$user_id}}';
            
            var userSwitch = switchId(userMain, userTarget);
            console.log(userSwitch);
            var data = {
              'user_id_one' : userSwitch[0],
              'user_id_two' : userSwitch[1],
              'status' : '1',
              'user_action' : userMain,
            };

            $.ajax({
              url : API_URL_CREATEFRIEND,
              method : 'POST',
              headers : {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
              data : data,  
              success : function(){
                console.log('data sent');
              }
            });
            

          });
          
            
        
        </script>
    </body>
</html>