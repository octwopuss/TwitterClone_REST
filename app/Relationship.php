<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
        'user_id_one',
        'user_id_two',
        'status',
        'action_user_id'
    ];
    protected $table = 'relationship';
}
