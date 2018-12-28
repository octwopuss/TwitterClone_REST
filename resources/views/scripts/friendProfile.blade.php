@extends('index')	

@section('style')		
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('importantPart')	
	<div class="row">			
  		<nav class="col-sm-3 col-md-3 hidden-xs-down bg-faded sidebar profile">
  			<div class="card">
					<p class="card-header">
						<a href="{{route('editProfile', $user->id)}}" style="color: white;">
							<i class="fa fa-edit"></i>Edit Profile
						</a>
					</p>
					<div class="card-body">
						<h4 class="card-title" style="text-align: center;">{{$user->name}}</h4>
						<img src="{{asset('storage/'.$user->userdetail->profilepic)}}" class="center rounded-circle">			    
						<center>{{'@'.$user->username}}</center>
						@if($user->id != Auth::guard('users')->user()->id)	
							@if($relationship == NULL)
							<p class="center hitFollow follow-box badge badge-info"><span class="follow-text">FOLLOW</span></p>
							@else
							<p class="center hitFollow follow-box badge badge-light"><span class="follow-text">FOLLOWED</span></p>
							@endif
						@else
						<br>
						@endif
						<meta name="csrf-token" content="{{ csrf_token() }}" />		    	
						<p class="card-text">{{$user->userdetail->biograph}}</p>
						<center>
							<a href="{{route('follows', $user->username)}}" class="card-link">Follows : {{$follows->follows}}</a>
							<a href="{{route('followers', $user->username)}}" class="card-link">Follower : {{$follows->follower}}</a>
						</center>
					</div>
			</div>
  		</nav>
  		<div class="col-md-5">
  			<div class="loading">
		      <center> <img src="{{asset('/img/loading2.gif')}}" style="width: 100px; height: 100px;"></center>                
		    </div>
			<div class="moments"></div>
  		</div>
  	</div>	
@endsection

@section('mainjs')
<script type="text/javascript">			
	const momentsElement = document.querySelector('.moments');     
	const loadingElement = document.querySelector('.loading');  	
	const API_URL = "{{route('friend.showPost', $user->username)}}";
	const API_ADD_FRIEND = "{{route('friend.create')}}";
	const API_CANCEL_FRIENDREQUEST = "{{route('friend.cancel')}}";
	const STORE_COMMENT = "{{route('comment.store', 'id')}}";
	const SHOW_COMMENT = "{{route('comment.show', 'id')}}";


	$('.hitFollow').click(function(){
		console.log('clicked');
		var followText = $('.follow-text').text();
		if(followText == 'FOLLOW'){
			$(this).removeClass('badge-info').addClass('badge-light');
			$('.follow-text').text('FOLLOWED');				
			let targetId = "{{$user->id}}";
			let me = "{{Auth::guard('users')->user()->id}}";			
			var action = {
				'user_id_one' : me,
				'user_id_two' : targetId,
				'status' : 1,
				'action_user_id' : "{{Auth::guard('users')->user()->id}}",
			}

			fetch(API_ADD_FRIEND, {
				method : 'POST',
				headers : {
					'Accept' : 'application/json',
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				credentials: "same-origin",
				body : JSON.stringify(action),				
			})
			.then(response => response.json())
			.then(json => console.log(json));
		}else{
			$(this).removeClass('badge-light').addClass('badge-info');
			$('.follow-text').text('FOLLOW');
			let targetId = "{{$user->id}}";
			let me = "{{Auth::guard('users')->user()->id}}";			
			var action = {
				'user_id_one' : me,
				'user_id_two' : targetId,			
			}

			fetch(API_CANCEL_FRIENDREQUEST, {
				method : 'POST',
				headers : {
					'Accept' : 'application/json',
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				credentials: "same-origin",
				body : JSON.stringify(action),				
			})					
		}
	});
	
	listAllMoments();	


	function switchId(idOne, idTwo){
		var data = [];
		var one, two;
		if(idOne > idTwo){
			var temp = idOne;
			one = idTwo;
			two = temp;						
			data = [one, two];
		}
		else{
			data = [idOne, idTwo];
		}

		return data;
	}

	function listAllMoments(){
	  momentsElement.innerHTML = '';                
	  fetch(API_URL)
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
	        const formComment = document.createElement('form');
	        const commentInput = document.createElement('input');
	        const commentBtn = document.createElement('button');
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
	        formComment.setAttribute('name', 'commentForm');                  
	        commentInput.style.borderRadius = '20px';
	        commentInput.setAttribute('placeholder', 'Say something about this..');
	        commentInput.setAttribute('type', 'text');
	        commentInput.style.width = '90%';
	        commentInput.style.height = '1.5em';
	        commentInput.style.padding = '1em';
	        commentInput.style.outlineStyle = 'none';
	        commentBtn.setAttribute('type', 'submit');
	        commentBtn.setAttribute('class', 'fa fa-paper-plane');
	        commentBtn.style.height = '2em';
	        commentBtn.style.borderRadius = '30px';
	        commentBtn.style.marginLeft = '1em';
	        commentBtn.style.outlineStyle = 'none';
	        commentBtn.onclick = (event) => {          
	          let comment = commentInput.value;

	          fetch(STORE_COMMENT.replace('id', moment.id), {
	            method : 'POST',
	            headers : {
	              'Content-type' : 'application/json',
	            },
	            body : JSON.stringify({
	              user_id : "{{Auth::guard('users')->user()->id}}",
	              posts_id : moment.id,
	              comment : comment
	            })
	          })
	          
	          commentInput.value = '';
	        } 

	        //DESCRIPTION 
	        desc.textContent = moment.description;                                

	        //TAGS
	        if(moment.tags.length >= 1){
	        span.textContent= "tags: ";                

	        tags.innerHTML = `${moment.tags.map((item, i)=> 
	          `<a href="#" style="text-decoration: none;"> <span class="badge badge-primary">${moment.tags[i]}</span> </a>`)}`;
	        }       

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
	              popularTagsElement.innerHTML = '';
	              listAllMoments();                 
	              popularMoments();           
	            },
	          });                  
	        }
	        
	        //CARD FOOTER
	        // const user = moment.username.replace(/ +/g,'');
	        cardFooter.innerHTML = ` <a href="/user/${moment.username}">${moment.name} </a>, dibuat pada ${moment.created_at}`;
	        if(moment.user_id == user_id){
	          cardFooter.appendChild(deleteButton);
	        }        

	         //COMMENT SECTION        
	        formComment.appendChild(commentInput);
	        formComment.appendChild(commentBtn);     

	        cardBody1.appendChild(desc);
	        cardBody2.appendChild(span);                
	        cardBody2.appendChild(tags);                

	        card.appendChild(image);                
	        card.appendChild(cardBody1);                
	        card.appendChild(cardBody2);
	        card.appendChild(cardFooter);
	        card.appendChild(formComment);                
	        fetch(SHOW_COMMENT.replace('id', moment.id))
	          .then(res => res.json())
	          .then(comments => {            
	            comments.forEach(comment => {
	              console.log(comment);
	              const commentDiv = document.createElement('div');
	              const commentedUser = document.createElement('a');         
	              const SHOWFRIEND = "{{route('showFriend', 'id')}}".replace('id', comment.user_commented);                        
	              commentDiv.setAttribute('class', 'card-footer text-muted');              
	              commentDiv.innerHTML = `<a href="${SHOWFRIEND}">${comment.user_commented}</a> ${comment.comment}`;
	              card.appendChild(commentDiv);
	            })                        
	          })

	        loadingElement.style.display = 'none';
	        
	        momentsElement.appendChild(card);
	      });              
	    });
	  }        
</script>
@endsection