<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable, Searchable;

    /**
     * 获取索引名称
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'users';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'student_id',
        'semester',
        'section_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function answers()
    {
        return $this->hasMany('App\Collected\Answer');
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
     * Get the answer record of a certain post
     */
    public function postRecord($post_id)
    {
        return $this->answerRecords()->where('post_id', $post_id);
    }

    /**
     * return if the user has completed registration
     * @return bool
     */
    public function isRegistered()
    {
        return null !== $this->postRecord(5)->first();
    }
}
