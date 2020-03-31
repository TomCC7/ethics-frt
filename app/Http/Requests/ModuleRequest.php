<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Requests will be sent here before sending to the controller
 */
class ModuleRequest extends FormRequest
{
    /**
     * rules for validation
     * @return array
     */
    public function rules()
    {
        switch ($this->type) {
            case 'text':
                return ['body' => 'required|min:10'];
                break;
            case 'filling':
                return [
                    'question' => 'required|min:3|max:250',
                    'short'    => 'required|boolean'
                ];
                break;
            case 'choice':
                return [
                    'question' => 'required|min:3|max:250',
                    'choices.*' => 'max:1000',
                ];
                break;
            case 'select':
                return [
                    'question' => 'required|min:3|max:250',
                    'options'  => 'max:10000',
                ];
            default:
                return [];
                break;
        }
    }
    /**
     * messages to be sent when not validated
     * @return array
     */
    public function messages()
    {
        return [
            'body.min' => 'The body must be at least 3 characters.',
            'choices.*.max' => 'Choices should be no more than 1000 character',
        ];
    }
}
