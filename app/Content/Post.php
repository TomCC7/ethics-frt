<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['prerequisite', 'title', 'slug', 'redirect', 'message','status'];
    /**
     * specify all statuses that is allowed
     * @var array
     */
    protected static $statuses=['unreleased','released','archived'];
    /** get statuses */
    public static function Statuses()
    {
        return self::$statuses;
    }
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
        return $this->answerRecords()->where('user_id', $user_id);
    }

    /**
     * return the link of the post
     */
    //public function link($params = [])
    //{
    //    return route('posts.show', [
    //        'cluster' => $this->cluster->slug,
    //        'post' => $this->slug
    //    ], $params);
    //}
    /**
      *
      * Change the route key name using in model binding
      * @return string
      */
    public function getRouteKeyName() {
        return 'slug';
    }
}
