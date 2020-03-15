<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['cluster_id','prerequisite','title'];

    public function modules() {
		return $this->hasMany('App\Content\Module');
	}

	public function cluster() {
		return $this->belongsTo('App\Content\Cluster');
	}
}
