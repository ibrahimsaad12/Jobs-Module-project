<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSkillUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // You can add authorization logic here if needed
    }

    public function rules()
    {
        return [


        ];
    }
}
