<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
   public function posts(Post $post){
    $posts = $post->all();

    return response()->json($posts);
   }
}
