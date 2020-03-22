<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
                // CREATE
            case 'POST':
                // UPDATE
            case 'PUT':
            case 'PATCH': {
                    return [
                        'question'       => 'required|min:2',
                        'choices' => 'required|max:50',
                    ];
                }
            case 'GET':
            case 'DELETE':
            default: {
                    return [];
                };
        }
    }

    public function messages()
    {
        return [

        ];
    }
}
