<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
             'reviewer_id' => 'nullable|exists:users,id',
             'reviewed_id' => 'nullable|exists:users,id',
             'rating' => 'nullable|numeric|min:1|max:10',
             'comment' => 'nullable|string',

         ];
     }
 }
