<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class CategoryJobController extends Controller
{

        public function attachCategory(Request $request, $jobId)
        {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
            ]);

            $job = Job::findOrFail($jobId);
            $job->categories()->attach($request->category_id);

            return response()->json(['message' => 'Category attached successfully.']);
        }

        public function detachCategory(Request $request, $jobId)
        {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
            ]);

            $job = Job::findOrFail($jobId);
            $job->categories()->detach($request->category_id);

            return response()->json(['message' => 'Category detached successfully.']);
        }

        public function listCategories($jobId)
        {
            $job = Job::findOrFail($jobId);
            return response()->json($job->categories);
        }
        public function updateCategories(Request $request, $jobId)
        {
            $request->validate([
                'category_ids' => 'required|array',
                'category_ids.*' => 'exists:categories,id',
            ]);

            $job = Job::findOrFail($jobId);

            // Sync the categories, this will attach new categories and detach the ones not in the array
            $job->categories()->sync($request->category_ids);

            return response()->json(['message' => 'Categories updated successfully.']);
        }

    }
