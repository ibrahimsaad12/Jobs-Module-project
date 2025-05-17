<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
           'name' => ['nullable', 'string', 'max:255'],

        ];
    }
}
