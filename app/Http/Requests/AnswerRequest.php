<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class AnswerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $types = $this->types;
        foreach ($this->answers as $module_id => $request_answer) {
            $optional=DB::table('modules')->where('id',$module_id)->first()->optional;
            if (!$optional)
            {
            $rules['answers.' . $module_id]='required';
            }
        }
        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     * @return array
     */

    public function messages()
    {
        return ['answers.*.required' => 'You should answer all question!'];
    }
}
