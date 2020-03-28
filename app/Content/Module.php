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
        'multiple-choice' => ['question', 'choices', 'choice-num', 'correct_answer', 'min', 'max'],
        'filling' => ['question', 'short'],
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
        switch ($request->type) {
            case 'text':
                return self::createText($request);
                break;
            case 'filling':
                return self::createFilling($request);
                break;
            case 'single-choice':
                // no break, will execute the next case
            case 'multiple-choice':
                return self::createChoice($request);
                break;
            default:
                return null;
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
    protected static function createText($request)
    {
        $content = json_encode($request->only(self::$attribute['text'])); // can't call $this because there's no instance for static method
        $module = self::create([
            'type' => 'text',
            'content' => $content,
        ]);
        $module->post_id = $request->post_id;
        $module->save();
        return $module;
    }

    /**
     * Create Module of type "filling"
     *
     * @static
     * @return App\Content\Module
     */
    protected static function createFilling($request)
    {
        $content = $request->only(self::$attribute['filling']); // can't call $this because there's no instance for static method
        $content['short'] = boolval($content['short']);
        $content = json_encode($content);
        $module = self::create([
            'type' => 'filling',
            'content' => $content,
        ]);
        $module->post_id = $request->post_id;
        $module->save();
        return $module;
    }

    /**
     * Create Module of type "choice"
     *
     * @static
     * @return App\Content\Module
     */
    protected static function createChoice($request)
    {
        $content = $request->only(self::$attribute[$request->type]);
        $content = json_encode($content);
        $module = self::create([
            'type' => $request->type,
            'content' => $content,
        ]);
        $module->post_id = $request->post_id;
        $module->save();
        return $module;
    }

    /**
     * return a scope where modules are questions
     * @return Facade\Ignition\QueryRecorder\Query
     */
    public function scopeQuestion($query)
    {
        return $query->where('type','!=','text');
    }

    /**
     * return a scope of given type
     * @return Facade\Ignition\QueryRecorder\Query
     */
    public function scopeOfType($query,$type)
    {
        return $query->where('type',$type);
    }
}
