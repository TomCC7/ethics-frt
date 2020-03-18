<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['cluster_id', 'prerequisite', 'title', 'slug'];

    public function modules()
    {
        return $this->hasMany('App\Content\Module');
    }

    public function cluster()
    {
        return $this->belongsTo('App\Content\Cluster');
    }

    /**
     *
     * Change the route key name using in model binding
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
