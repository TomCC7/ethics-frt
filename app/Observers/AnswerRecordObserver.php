<?php

namespace App\Observers;

use App\Collected\AnswerRecord;

class AnswerRecordObserver
{
    public function deleted(AnswerRecord $answerRecord)
    {
        $answerRecord->answers()->delete();
    }
}
