<?php

namespace App\Collected;

use Illuminate\Database\Eloquent\Model;

class AnswerRecord extends Model
{
    /**
     * variables that can be mass assignable
     *
     * @var array
     */
    protected $fillable = [];

    /** Relationships with other models @return relation */
    /**
     * The relationship with Post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Content\Post');
    }

    /**
     * The relationship with User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeOfUser($query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }
    public function scopeOfPost($query,$post_id)
    {
        return $query->where('post_id',$post_id);
    }
    public function scopeFindUnique($query,$user_id,$post_id)
    {
        return $query->where('post_id',$post_id)->where('user_id',$user_id);
    }
}
