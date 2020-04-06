<?php

namespace App\Observers;

use App\Content\Module;

class ModuleObserver
{
    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Content\Module  $module
     * @return void
     */
    public function forceDeleted(Module $module)
    {
        // delete also the answer record
        $module->answers()->first()->answerRecord()->delete();
        // delete all the modules of the cluster
        $module->answers()->forceDelete();
    }
}
