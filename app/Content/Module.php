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
    protected $fillable = ['type', 'content', 'optional'];

    /**
     * The attribute of different types of modules
     *
     * @static so that can be called by static functions
     * @var array
     */
    protected static $attribute = [
        'text' => ['body'],
        'choice' => ['question', 'choices', 'correct_answer', 'choice_num', 'is_multiple', 'min', 'max'],
        'filling' => ['question', 'short'],
        'select' => ['question', 'options'],
    ];

    /**
     * Get the attribute of this model
     *
     * @return array
     */
    public function Attribute()
    {
        return self::$attribute[$this->type];
    }

    /**
     * Get all types of module
     * @static
     * @return array
     */
    public static function getType()
    {
        return array_keys(self::$attribute);
    }

    /** Relationships with other models @return relation */
    /**
     * The relationship with post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Content\Post');
    }

    /**
     * The relationship with answer
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
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
    public static function createByType($request)
    {
        $content = $request->only(self::$attribute[$request->type]); // can't call $this because there's no instance for static method
        // do some convertion
        switch ($request->type) {
            case 'filling':
                $content['short'] = boolval($content['short']);
                break;
            case 'select':
                $content['options'] = explode("\r\n", $content['options']);
            default:
                break;
        }
        $module = self::make([
            'type' => $request->type,
            'content' => json_encode($content),
            'optional' => $request->optional,
        ]);
        $module->post_id = $request->post_id;
        $module->save();
        return $module;
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
     * return a scope where modules are questions
     * @return Facade\Ignition\QueryRecorder\Query
     */
    public function scopeQuestion($query)
    {
        return $query->where('type', '!=', 'text');
    }

    /**
     * return a scope of given type
     * @return Facade\Ignition\QueryRecorder\Query
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
