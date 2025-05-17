<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Change this if you want to implement authorization
    }

    public function rules()
    {
        return [
           'name' => ['required', 'string', 'max:255'],

        ];
    }
}
