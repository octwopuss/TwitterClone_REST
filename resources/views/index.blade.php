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

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div> -->
        </nav>
        <div class="container-fluid">
          <div class="row">
            <nav class="col-sm-3 col-md-3 hidden-xs-down bg-faded sidebar">
              <form id="postForm">
                <div class="form-group">
                  <h3>Description</h3>
                  <textarea class="form-control" rows="4" name="description" id="description"></textarea>
                  <label for="upload_image" class="input-group-append btn btn-warning">+ upload image</label>
                  <input type="file" id="upload_image">
                </div>
                <button type="submit" class="btn btn-primary" >Post!</button>
              </form>
            </nav>
            <div class="col-md-5">
            @foreach($posts as $post)
            
            @php         
              $tags = explode(",", $post->tags);
            @endphp
              <div class="card mb-3">                
                <img class="rounded" style="height: 450px; width: 100%; display: block;" 
                src="{{$post->image}}" alt="Card image">
                <div class="card-body">
                  <p class="card-text">{{$post->description}}</p>
                </div>                
                <div class="card-body">
                <span>tags : &nbsp;&nbsp;&nbsp;</span>
                @foreach($tags as $tag)
                  <a href="#" class="card-link">{{$tag}}</a>
                @endforeach
                
                </div>
                <div class="card-footer text-muted">
                  2 days ago
                </div>
              </div>
            @endforeach
            </div>
            <div class="col-md-2">
             <div class="container-fluid">
               <h2>Popular Tags</h2>
               <span class="badge badge-primary">Cat</span>   
               <span class="badge badge-primary">Dog</span>          
               <span class="badge badge-primary">Tiger</span>
               <span class="badge badge-primary">Cat</span>   
               <span class="badge badge-primary">Dog</span>          
               <span class="badge badge-primary">Tiger</span>
               <span class="badge badge-primary">Cat</span>   
               <span class="badge badge-primary">Dog</span>          
               <span class="badge badge-primary">Tiger</span>
               <span class="badge badge-primary">Cat</span>   
               <span class="badge badge-primary">Dog</span>          
               <span class="badge badge-primary">Tiger</span>
             </div>
            </div>
          </div>
        </div>

        <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
        <script src="https://bootswatch.com/_vendor/popper.js/dist/umd/popper.min.js"></script>
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://bootswatch.com/_assets/js/custom.js"></script>
        <script type="text/javascript">
        document.querySelector("#postForm")
          .addEventListener("submit", function(event){
            event.preventDefault();
            var description = $('#description').val();
            var path = $('#upload_image').val();
            var image = path.replace(/^.*\\/, "");
            console.log(description, image);
          });
        

        </script>
    </body>
</html>