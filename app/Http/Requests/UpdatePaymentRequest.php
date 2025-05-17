<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'amount' => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'transaction_id' => 'nullable|string',
            'status' => 'nullable|string',

        ];
    }
}
