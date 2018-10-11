<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Post;

class PostController extends Controller
{
   public function posts(Post $post){   	
    $posts = $post->all();

    return response()->json($posts);
   }

   public function store(Request $request){


  //  	$validation = $request->validate([
  //  		'upload_image' => 'required | image | mimes:jpeg,png,jpg,gif | max:2048',
		// 'description' => 'required'
  //  	]);   	

	$post = new Post();		      	

  	if($request->hasFile('upload_image')){
        $fileName = $request->file('upload_image')->store('moments_image', 'local');            

        $post->image = $fileName;
    }   	
   	$post->description = $request->description;
   	$post->save();

   	$data = [   		
   		'description' => $request->description,
   		'image' => $request->upload_image
   	];

   	$response = [
   		'message' => 'Moment created!',
   		'data' => $data,
   	];

   	return response()->json($response, 201);
	} 	

}
