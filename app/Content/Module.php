<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * variables that can be mass assignable
     *
     * @var array
     */
    protected $fillable = ['type', 'content'];

    /**
     * The attribute of different types of modules
     *
     * @static so that can be called by static functions
     * @var array
     */
    protected static $attribute = [
        'text' => ['body'],
        'single-choice' => ['question', 'choices', 'correct_answer'],
        'multiple-choice' => ['question', 'choices', 'correct_answer', 'min', 'max'],
        'filling' => ['question', 'short'],
    ];

    /**
     * The relationship with post
     *
     * @return App\Content\Post
     */
    public function post()
    {
        return $this->belongsTo('App\Content\Post');
    }

    /**
     * The relationship with answer
     *
     * @return App\Collected\Answer
     */
    public function answers()
    {
        return $this->hasMany('App\Collected\Answer');
    }

    /**
     * Get the content of a module
     *
     * @return string/array
     */
    public function getContent()
    {
        return json_decode($this->content);
    }

    /**
     * Distributes creating tasks based on the type of the module
     *
     * @static
     * @return App\Content\Module
     */
    public static function createByType($type, $request, $post_id)
    {
        switch ($type) {
            case 'text':
                return self::createText($request, $post_id);
                break;

            default:
                break;
        }
    }

    /**
     * Distributes creating tasks based on the type of the module
     *
     * @static
     * @return App\Content\Module
     */
    public static function updateByType($type, $request, $post_id)
    {
        switch ($type) {
            case 'text':
                return self::updateText($request, $post_id);
                break;

            default:
                break;
        }
    }

    /**
     * Create Module of type "text"
     *
     * @static
     * @return App\Content\Module
     */
    protected static function createText($request, $post_id)
    {
        $content = json_encode($request->only(self::$attribute['text'])); // can't call $this because there's no instance for static method
        $module = self::create([
            'type' => 'text',
            'content' => $content,
        ]);
        $module->post_id = $post_id;
        $module->save();
        return $module;
    }
}
