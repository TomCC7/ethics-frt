<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable=['type','content'];
    // relationships
    public function post() {
		return $this->belongsTo('App\Content\Post');
	}

	public function answers() {
		return $this->hasMany('App\Collected\Answer');
    }

    public function getContent()
    {
        //switch the type of the module
        switch ($this->type)
        {
            case 'text':
                return $this->textHandler();
            break;

            defualt:
        break;
        }
    }

    private function textHandler()
    {
        return json_decode($this->content)->body;
    }
}
