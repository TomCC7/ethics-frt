<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content\Post;
use App\Content\Module;
use App\Http\Requests\ModuleRequest;

class ModulesController extends Controller
{

    /**
     * Store a module
     */
    public function store(ModuleRequest $request)
    {
        $post = Post::Find($request->post_id);
        Module::createByType($request);
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Module created successfully!');
    }
    /**
     * Update a module
     */
    /**
     * Edit a module
     */
    // public function edit(Module $module)
    // {
    //     return view('modules.edit', compact('module'));
    // }
}
