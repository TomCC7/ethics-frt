<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use League\Csv\Reader;
use League\Csv\Writer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use SplTempFileObject;
use App\Content\Module;
use App\Content\Post;

class AnswersDownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Convert the data to csv file and return a download file
     *
     */
    public function download(Request $request)
    {
        $csv = '';
        $file_name = '';
        switch ($request->type) {
            case 'detail':
                $module = Module::Find($request->module_id);
                $csv = $this->detailHandler($request->module_id);
                $file_name = 'detail_' . $module->getContent()->question . '.csv';
                break;
            case 'post':
                $post = Post::Find($request->post_id);
                $csv = $this->PostHandler($request->post_id);
                $file_name = 'post_' . $post->slug . '.csv';
                break;
            default:
                break;
        }
        return response((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
        ]);
    }

    protected function DetailHandler($module_id)
    {
        $module = Module::Where('id', $module_id)->with('answers.answerRecord.user')->first();
        // create a new instance in the buffer
        $csv = Writer::createFromFileObject(new SplTempFileObject);
        if (
            $module->type === 'choice'
            && ($module->getContent()->subtype === 'single' || $module->getContent()->subtype === 'multiple')
        ) {
            // insert the header
            $header = ['student_id'];
            foreach ($module->getContent()->options as $option) {
                $header[] = $option;
            }
            $csv->insertOne($header);
            // insert every record
            foreach ($module->answers as $answer) {
                $record = [$answer->answerRecord->user->student_id];
                if (is_array($answer->getContent())) {
                    foreach ($module->getContent()->options as $option) {
                        $record[] = in_array($option, $answer->getContent()) ? '1' : '0';
                    }
                } else {
                    foreach ($module->getContent()->options as $option) {
                        $record[] = in_array($option, array($answer->getContent())) ? '1' : '0';
                    }
                }
                $csv->insertOne($record);
            }
        } else {
            // insert the header
            $csv->insertOne(['student id', 'Answer']);
            // insert every record
            foreach ($module->answers as $answer) {
                $csv->insertOne([$answer->answerRecord->user->student_id, $answer->getContent()]);
            }
        }
        return $csv;
    }

    /**
     * handle the post csv file
     */
    protected function PostHandler($post_id)
    {
        $post = Post::Where('id', $post_id)->with(['modules'])->first();
        $modules = $post->modules()->question()->get();
        $csv = Writer::createFromFileObject(new SplTempFileObject);
        // header
        $header = ['student_id', 'submit time'];
        foreach ($modules as $index => $module) {
            if ($module->getContent()->subtype === 'multiple') {
                for ($i = 0; $i < count($module->getContent()->options); $header[] = $index + 1 . '.' . (++$i));
            } else {
                $header[] = $index + 1;
            }
        }
        $csv->insertOne($header);
        // records
        foreach ($post->answerRecords()->orderby('updated_at', 'desc')->with('user')->get() as $index => $answerRecord) {
            $record = [$answerRecord->user->student_id, $answerRecord->updated_at];
            foreach ($modules as $index => $module) {
                // get the answer of the module
                $answer = $answerRecord->answerOfModule($module->id);
                if ($answer) {
                    if ($module->getContent()->subtype === 'multiple') {
                        foreach ($module->getContent()->options as $option) {
                            $record[] = in_array($option, array($answer->getContent())) ? '1' : '0';
                        }
                    } else {
                        $record[] = $answer->getContent();
                    }
                } else {
                    // if no answer, return -1 indicates not answered
                    if ($module->getContent()->subtype === 'multiple') {
                        foreach ($module->getContent()->options as $option) {
                            $record[] = -1;
                        }
                    } else {
                        $record[] = -1;
                    }
                }
            }
            $csv->insertOne($record);
        }
        return $csv;
    }
}
