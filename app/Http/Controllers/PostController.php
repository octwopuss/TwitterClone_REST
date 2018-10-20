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
use App\Relationship;

class PostController extends Controller
{

   public function posts(Post $post){   	   	
    $posts = $post->all();
    $data = array();    
    $tagsData = array();
    foreach($posts as $post){
    	$username = Post::find($post->id)->user->name;    	
    	$post_tags = DB::table('post_tags')->where('post_id', $post->id)->get();
    	$tagsData = [];
    	foreach($post_tags as $tag){
    		$tags = Tags::find($tag->tags_id);
    		$tagsData[] = $tags->tags;
		}

		$date = date('d/m/Y h:i:s', strtotime($post->created_at));		    
		$data[] = [
    		'id' => $post->id,
    		'user_id' => $post->user_id,
    		'username' => $username,
    		'description' => $post->description,
    		'image' => $post->image,
    		'tags' => $tagsData,
    		'created_at' => $date,
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

	public function popularTags(){
		$tags = DB::table('tags')->orderBy('popularity', 'desc')->take(5)->get();
		$popularTags = array();		
		foreach($tags as $tag){
			$popularTags[] = $tag->tags;
		}		

		return response()->json($popularTags, 200);
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

	public function createFriendship(Request $request){
		Relationship::create([
			"user_id_one" => $request->user_id_one,
			"user_id_two" => $request->user_id_two,
			"status" => $request->status,
			"action_user_id" => $request->user_action,
		]);

		$data = [
			"user_id_one" => $request->user_id_one,
			"user_id_two" => $request->user_id_two,
			"status" => $request->status,
			"user_action" => $request->user_action,
		];

		$response = [
			'message' => 'Friend Added!, waiting for respond',
			'data' => $data,
		];

		return response()->json($response, 200);
	}
}
