<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
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
        'choice' => ['subtype', 'question', 'options', 'choice_num'],
        'filling' => ['question', 'short'],
    ];

    /**
     * The subtypes of modules
     * @var array
     */
    protected static $subtypes = [
        'choice' => ['single', 'multiple', 'select','datalist'],
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
     * Get the subtypes of this model
     * @param string $type
     * @return array
     */
    public function Subtypes($type = '')
    {
        if ($type === '') {
            return self::$subtypes[$this->type];
        } else {
            return self::$subtypes[$type];
        }
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
     * access and return the content from the request
     * @param Request $request
     * @return array
     */
    public static function handleContent($request)
    {
        $content = $request->only(self::$attribute[$request->type]); // can't call $this because there's no instance for static method
        // do some convertion
        switch ($request->type) {
            case 'filling':
                $content['short'] = boolval($content['short']);
                break;
            case 'choice':
                $content['options'] = explode("\r\n", $content['options']);
            default:
                break;
        }
        return json_encode($content);
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
