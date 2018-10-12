<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use App\Post;

class PostController extends Controller
{

   public function posts(Post $post){   	
    $posts = $post->all();

    return response()->json($posts);
   }

   public function store(Request $request){

   	$validation = $request->validate([
   		'upload_image' => 'max:2048',
   	]);   	

	$post = new Post();		      	

  	if($request->hasFile('upload_image')){
        $fileName = $request->file('upload_image')->store('moments_image', 'public');            

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

	public function delete($id){
		$post = Post::find($id);
		File::delete('storage/'.$post->image);
		$post->delete();

		$response = [
			'message' => 'Moment successfully deleted!',
			'data' => []
		];

		return response()->json($response, 204);
	}
}
