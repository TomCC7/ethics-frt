<?php

namespace App\Observers;

use App\Content\Module;

class ModuleObserver
{
    /**
     * Handle the post "force deleting" event.
     *
     * @param  \App\Content\Module  $module
     * @return void
     */
    public function forceDeleting(Module $module)
    {
        // delete also the answer record
        $module->answers()->first()->answerRecord()->delete();
        // delete all the modules of the cluster
        foreach ($module->answers as $answer) {
            $answer->delete();
        }
    }
}
