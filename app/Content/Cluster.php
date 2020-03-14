<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    public function posts() {
		return $this->hasMany('App\Content\Post');
	}
}
