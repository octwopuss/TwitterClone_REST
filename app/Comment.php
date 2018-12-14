<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['comment', 'posts_id'];
    public function post(){
        return $this->belongsTo('App\Post', 'posts_id');
    }
}
