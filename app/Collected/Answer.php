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

    /**
     * return a scope of given module_id
     * @param $module_id
     *
     */
    public function scopeOfModule($query,$module_id)
    {
        return $query->where('module_id',$module_id);
    }

    // public function scopeOfChoice($query,$index)
    // {
    //     return $query->where('')
    // }
}
