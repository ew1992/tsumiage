<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'stack_thing',
        'reflection_point',
        'user_id',
        'created_at',
        'updated_at',
        'private_flag'
        
    ];

    public function user(){
		return $this->belongsTo('App\User');
	}
}
