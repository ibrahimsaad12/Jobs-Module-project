<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change this if you want to implement authorization
    }

    public function rules()
    {
        return [
            'job_id' => 'required|exists:jobs,id',
            'user_id' => 'required|exists:users,id',
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx',
            'status' => 'required|string|in:applied,interviewed,offered,accepted,rejected', // Example statuses
        ];
    }

}
