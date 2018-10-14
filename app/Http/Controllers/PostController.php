<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use File;
use Auth;
use Validator;
use App\Post;
use App\Tags;

class PostController extends Controller
{

   public function posts(Post $post){   	
    $posts = $post->all();
    $data = array();

    foreach($posts as $post){
    	$username = Post::find($post->id)->user->name;
    	$tags = 
    	$data[] = [
    		'id' => $post->id,
    		'user_id' => $post->user_id,
    		'username' => $username,
    		'description' => $post->description,
    		'image' => $post->image,
    		'created_at' => $post->created_at,
    	];
    }

    return response()->json($data);
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
	$post->user_id = $request->user_id;
   	$post->description = $request->description;
   	$post->save();

   	$tagsList = explode(",", $request->tags);
   	foreach($tagsList as $tag){
   		if(Tags::where('tags', $tag)->exists()){
   			$popularity = Tags::where('tags', $tag)->first();
   			Tags::where('tags', $tag)->update([
   				'popularity' => $popularity->popularity + 1,
   			]);
   		}else{
   			$dataPost = Post::findOrFail($post->id);
   			$dataPost->tags()->create([
   				'tags' => $tag,
   			]);
   		}
   	}   	

   	$data = [   		
   		'id' => $request->user_id,
   		'description' => $request->description,
   		'image' => $request->upload_image,
   		'tags' => $request->tags,
   	];

   	$response = [
   		'message' => 'Moment created!',
   		'data' => $data,
   	];

   	return response()->json($response, 201);
	} 	

	public function delete($id){
		$post = Post::find($id);
		$post_tags = DB::table('post_tags')->where('post_id', $id)->get();
		foreach($post_tags as $tag){
			DB::table('tags')->where('id', $tag->tags_id)->delete();
		}	
		$post_tags = DB::table('post_tags')->where('post_id', $id)->delete();				
		File::delete('storage/'.$post->image);
		$post->delete();

		$response = [
			'message' => 'Moment successfully deleted!',
			'data' => []
		];

		return response()->json($response, 204);
	}
}
