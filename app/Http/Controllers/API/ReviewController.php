<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Review::all();

        return response()->json([
            'success' => true,
            'data' => $review,

        ], 200);
    }

    public function post(PostReviewRequest $request)
    {
        $review = new Review([
            'reviewer_id' => $request->reviewer_id,
            'reviewed_id' => $request->reviewed_id,
            'rating' => $request->rating,
            'comment' => $request->comment,

        ]);
        $review->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $review,
    ], 201);

}
public function destroy($id)
{
    $review = Review::find($id);

    if (!$review) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $review->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}
public function update(UpdateReviewRequest $request, $id)
{
    $review = Review::find($id);
// Debugging: Log the incoming request data

    if (!$review) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
   if ($request->has('reviewer_id')) {
        $review->reviewer_id = $request->reviewer_id;
    }
    if ($request->has('reviewed_id')) {
        $review->reviewed_id = $request->reviewed_id;
    }
    if ($request->has('rating')) {
        $review->rating = $request->rating;
    }
    if ($request->has('comment')) {
        $review->comment = $request->comment;
    }



    $review->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $review,
    ], 200);
}
}


