<script type="text/javascript">

const momentsElement = document.querySelector('.moments');        
const popularElement = document.querySelector('.popularTags');
const form = document.querySelector('form');
const loadingElement = document.querySelector('.loading');  
const deleteButton = document.querySelector('#deletePost');              
const API_URL = 'http://localhost:8000/api/posts';        
const TAGS_API_URL = 'http://localhost:8000/api/popularTags'

popularMoments();
listAllMoments();

function popularMoments(){
  fetch(TAGS_API_URL)
    .then((response)=>response.json())
    .then((tags)=>{
      tags.forEach((tag)=>{
        const tags = document.createElement('span');                
        tags.innerHTML = `<span class="badge badge-primary">${tag}</span>` + ` `;
        popularElement.appendChild(tags);
      }); 
    });
}

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
        const imagePath = window.location.origin + '/storage/' + moment.image;
        const deleteButton = document.createElement('a');
        const user_id = "{{Auth::guard('users')->id()}}";
        const username = moment.id;                

        card.setAttribute('class', 'card mb-3');
        image.setAttribute('class', 'rounded');
        image.setAttribute('src', imagePath);
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
        if(moment.tags.length >= 1){
        span.textContent= "tags: ";                

        tags.innerHTML = `${moment.tags.map((item, i)=> 
          `<a href="#" style="text-decoration: none;"> <span class="badge badge-primary">${moment.tags[i]}</span> </a>`)}`;
        }

        //BREAD FOOTER
        deleteButton.setAttribute('class', 'badge badge-danger');  
        deleteButton.setAttribute('id', 'deletePost');   
                                               
        deleteButton.textContent = 'Delete';
        deleteButton.style.float = 'right';   
        deleteButton.href = '#';
        deleteButton.onclick = () => {
          $.ajax({
            url : API_URL + '/' + moment.id,
            method : 'DELETE',
            headers : {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },                    
            success : function(){              
              listAllMoments();                            
            },
          });                  
        }
        
        //CARD FOOTER
        
        cardFooter.innerHTML = ` <a href="/user/${moment.username}">${moment.username} </a>, dibuat pada ${moment.created_at}`;
        if(moment.user_id == user_id){
          cardFooter.appendChild(deleteButton);
        }
        
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
  var user_id = "{{Auth::guard('users')->id()}}";
  var tags = $('#tags').val();  
  data.append('tags', tags);
  data.append('user_id', user_id);        
  console.log(data.tags);
  loadingElement.style.display = 'block';
  $.ajax({
    url : API_URL,
    method : 'POST',
    headers : {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data : data,
    enctype: 'multipart/form-data',            
    success : function(){
      listAllMoments();
      popularTags.innerHTML = '';      
      popularMoments();    
    },
    contentType : false, // prevents ajax sending the content type header.The content type header make Laravel 
                        // handel the FormData Object as some serialized string.                
    cache : false,
    processData : false,
  });
});

</script>