<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'message' => 'nullable|string',
            'type' => 'nullable|string',
            'is_read' => 'nullable|boolean',

        ];
    }
}

