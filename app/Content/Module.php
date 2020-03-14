<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function post() {
		return $this->belongsTo('App\Content\Post');
	}
	
	public function answers() {
		return $this->hasMany('App\Collected\Answer');
	}
}
