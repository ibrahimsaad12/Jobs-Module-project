<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\PostCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched posts!',
            'data' => $category,
        ], 200);
    }

    public function post(PostCategoryRequest $request)
{
    $category = new Category([
        'name' => $request->name,
    ]);
    $category->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $category,
    ], 201);

}
public function destroy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $category->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}
public function update(UpdatecategoryRequest $request, $id)
{
    $category = Category::find($id);
// Debugging: Log the incoming request data

    if (!$category) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
    if ($request->has('name')) {
        $category->name = $request->name;
    }


    $category->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $category,
    ], 200);
}
}


