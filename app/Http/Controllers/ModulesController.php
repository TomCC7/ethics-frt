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
            'cluster' => $post->cluster_id,
            'post' => $post->id,
            'post_slug' => $post->slug,
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
        $content = json_encode($request->only($module->Attribute()));
        $module->update([
            'type' => $request->type,
            'content' => $content
        ]);
        return redirect()->route('posts.show', [
            'cluster' => $post->cluster_id,
            'post' => $post->id,
            'post_slug' => $post->slug,
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
        // delete the answers
        foreach ($module->answers as $answer) {
            $answer->delete();
        }
        // delete the module itself
        $module->delete();
        return back()->with('success', 'You have already deleted this module!');
    }
}
