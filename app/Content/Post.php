<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['cluster_id', 'prerequisite', 'title', 'slug'];

    /**
     * The relationship with modules
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function modules()
    {
        return $this->hasMany('App\Content\Module');
    }

    /**
     * The relationship with cluster
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cluster()
    {
        return $this->belongsTo('App\Content\Cluster');
    }

    /**
     * The relationship with answerrecords
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function answerRecords()
    {
        return $this->hasMany('App\Collected\AnswerRecord');
    }

    /**
     * Get the answerrecord of a certain user
     */
    public function userRecord($user_id)
    {
        return $this->answerRecords()->where('user_id',$user_id);
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
