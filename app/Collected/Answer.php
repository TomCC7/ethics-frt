<?php

namespace App\Collected;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = [
		'content',
	];

    public function user() {
		return $this->belongsTo('App\User');
	}

	public function module() {
		return $this->belongsTo('App\Content\Module');
	}
}
