<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostNotificationRequest extends FormRequest
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
            'message' => 'required|string',
            'type' => 'required|string',
            'is_read' => 'required|boolean',

        ];
    }
}

