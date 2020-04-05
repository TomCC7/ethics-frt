<?php

namespace App\Collected;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class Answer extends Model
{
    protected $fillable = [
        'content',
    ];

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo('App\Content\Module');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answerRecord()
    {
        return $this->belongsTo('App\Collected\AnswerRecord');
    }

    public function getContent()
    {
        return json_decode($this->content);
    }

    public function handleContent(Request $request)
    {
        
    }
    // public function scopeOfChoice($query,$index)
    // {
    //     return $query->where('')
    // }
}
