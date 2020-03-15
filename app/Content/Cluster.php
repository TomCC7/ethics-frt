<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $fillable=['name'];

    // relationship
    public function posts() {
		return $this->hasMany('App\Content\Post');
	}
}
