<?php
// this file deal with verifying the data transferred by users
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
                // CREATE
            case 'POST':
                return [
                    'title'       => 'required|min:2',
                    'cluster_id' => 'required|numeric',
                    'message' => 'max:1000',
                    'redirect' => 'max:1000',
                    'prerequesite' => 'numeric',
                ];
                break;
                // UPDATE
            case 'PUT':
            case 'PATCH':
                return [
                    'title'       => 'required|min:2',
                    'message' => 'max:1000',
                    'redirect' => 'max:1000',
                    'prerequesite' => 'numeric',
                ];
                break;
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
            'title.min' => 'title must be at least two characters',
            'body.min' => 'The content should have at least 3 characters',
        ];
    }
}
