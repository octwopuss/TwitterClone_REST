<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        'description',
        'image',
        'tags',
    ];

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function tags(){
    	return $this->belongsToMany('App\Tags', 'post_tags');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }
}
