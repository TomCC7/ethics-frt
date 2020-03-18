<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     *
     * Return all posts the cluster has
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Content\Post');
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
