<?php

namespace App\Http\Controllers;

use App\Content\Post;
use App\Content\Module;
use App\Http\Requests\ModuleRequest;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Auth;
use League\Csv\Reader;

class ModulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'optional' => $request->optional or false,
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
        return back()->with('success', 'You have deleted this module!');
    }

    /** handle the image upload in the text module */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // initialize the data with false value
        $data = [
            'success'   => false,
            'msg'       => 'upload failed!!',
            'file_path' => ''
        ];
        // determine whether there's files uploaded
        if ($file = $request->upload_file) {
            // save the file
            $result = $uploader->save($file, 'posts', Auth::id());
            // if success
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "uploaded!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}
