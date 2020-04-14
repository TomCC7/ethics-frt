<?php

namespace App\Observers;

use App\Collected\AnswerRecord;

class AnswerRecordObserver
{
    public function deleting(AnswerRecord $answerRecord)
    {
        $answerRecord->answers()->delete();
    }
}
