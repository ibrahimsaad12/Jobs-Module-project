<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostJobRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'salary_range' => 'required|string',
            'job_type' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|String',
            'is_premium' => 'required',

        ];
    }
}
