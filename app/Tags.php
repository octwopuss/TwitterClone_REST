<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
	protected $fillable = ['tags'];
	
    public function post(){
    	return $this->belongsToMany('App\Post', 'post_tags');
    }
}
