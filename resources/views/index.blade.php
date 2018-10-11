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
            <a class="navbar-brand" href="#">Bagi Momen <i class="fa fa-heart"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>            
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

        const momentsElement = document.querySelector('.moments');        
        const form = document.querySelector('form');
        const loadingElement = document.querySelector('.loading');                
        const API_URL = 'http://localhost:8000/api/posts';
        listAllMoments();

        function listAllMoments(){
          momentsElement.innerHTML = '';                    
          fetch(API_URL, {method: 'GET'})
            .then((response)=> response.json())
            .then((moments)=> { 
              console.log(moments);
              moments.reverse();
              moments.forEach(moment => {                          
                const card = document.createElement('div');                
                const cardBody1 = document.createElement('div');
                const cardBody2 = document.createElement('div');
                const cardFooter = document.createElement('div');
                const span = document.createElement('span');
                const tags = document.createElement('a'); 
                const desc = document.createElement('p');  
                const image = document.createElement('img'); 
                
                card.setAttribute('class', 'card mb-3');
                image.setAttribute('class', 'rounded');
                image.setAttribute('src', moment.image);
                image.style.height = '100%';
                image.style.width = '100%';
                image.style.display = 'block';
                cardBody1.setAttribute('class', 'card-body');
                cardBody2.setAttribute('class', 'card-body');
                tags.setAttribute('class', 'card-link');
                cardFooter.setAttribute('class', 'card-footer text-muted');                

                //DESCRIPTION 
                desc.textContent = moment.description;                                

                //TAGS
                span.textContent= "tags: ";
                tags.textContent = moment.tags;
                tags.href = "#";

                //CARD FOOTER
                cardFooter.textContent = moment.created_at;
                
                cardBody1.appendChild(desc);
                cardBody2.appendChild(span);                
                cardBody2.appendChild(tags);                

                card.appendChild(image);                
                card.appendChild(cardBody1);                
                card.appendChild(cardBody2);
                card.appendChild(cardFooter);

                loadingElement.style.display = 'none';
                
                momentsElement.appendChild(card);
              });              
            });
          }

        form.addEventListener('submit', function(event){
          event.preventDefault();                 
          var description = $('#description').val();          
          let data = new FormData(this);          
          data.append('description', description);
          loadingElement.style.display = 'block';
          $.ajax({
            url : API_URL,
            method : 'POST',
            headers : {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : data,
            enctype: 'multipart/form-data',            
            success : listAllMoments(),
            contentType : false, // prevents ajax sending the content type header.The content type header make Laravel 
                                // handel the FormData Object as some serialized string.                
            cache : false,
            processData : false,
          });
        });
        

        </script>
    </body>
</html>