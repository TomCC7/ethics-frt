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
        // return the content from the request
        $content = Module::handleContent($request);
        $module = Module::Make([
            'type' => $request->type,
            'content' => $content,
            'optional' => $request->optional ? $request->optional : false,
        ]);
        $module->post_id = $request->post_id;
        $module->save();
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Module created successfully!');
    }

    /**
     * Update a module
     * @param App/Http/Requests/ModuleRequest $request
     * @param App/Content/Module $module
     */
    public function update(ModuleRequest $request, Module $module)
    {
        $post = $module->post;
        $content = Module::handleContent($request);
        $module->update($request->toArray());
        $module->update(['content' => $content]);
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster->slug,
            'post' => $post->slug,
        ])
            ->with('success', 'Module Updated successfully!');
    }

    /**
     * Edit a module
     * @param App/Content/Module $module
     */
    public function edit(Module $module)
    {
        $post = $module->post;
        return view('modules._edit._edit', compact('module', 'post'));
    }

    /**
     * Delete a module
     * @param App/Content/Module $module
     */
    public function destroy(Module $module)
    {
        // delete the module itself
        $module->delete();
        return back()->with('success', 'You have already deleted this module!');
    }
}
