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
     * @const array
     */
    protected const Attribute = [
        'text' => ['body'],
        'choice' => ['...']
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
        //switch the type of the module
        switch ($this->type) {
            case 'text':
                return $this->getText();
                break;

                defualt: break;
        }
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
                return Module::createText($request, $post_id);
                break;

            default:
                break;
        }
    }

    /**
     * Get the content of a module of type "text"
     *
     * @return string
     */
    protected function getText()
    {
        return json_decode($this->content)->body;
    }

    /**
     * Create Module of type "text"
     *
     * @static
     * @return App\Content\Module
     */
    protected static function createText($request, $post_id)
    {
        $content = json_encode($request->only(Module::Attribute['text']));
        $module = Module::create([
            'type' => 'text',
            'content' => $content,
        ]);
        $module->post_id = $post_id;
        $module->save();
        return $module;
    }
}
