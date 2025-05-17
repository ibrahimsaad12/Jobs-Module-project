<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Requests\PostJobRequest;
use App\Http\Requests\UpdateJobRequest;

class JobController extends Controller
{
    public function index()
    {
        $job = Job::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched posts!',
            'data' => $job,
        ], 200);
    }

    public function post(PostJobRequest $request)
{
    $job = new Job([
        'user_id' => $request->user_id,
        'title' => $request->title,
        'description' => $request->description,
        'salary_range' => $request->salary_range,
        'job_type' => $request->job_type,
        'location' => $request->location,
        'status' => $request->status,
        'is_premium' => $request->is_premium,
    ]);
    $job->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $job,
    ], 201);

}
public function destroy($id)
{
    $job = Job::find($id);

    if (!$job) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $job->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}

public function update(UpdateJobRequest $request, $id)
{
    $job = Job::find($id);
// Debugging: Log the incoming request data

    if (!$job) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
    if ($request->has('user_id')) {
        $job->user_id = $request->user_id;}
    if ($request->has('title')) {
        $job->title = $request->title;}
    if ($request->has('description')) {
        $job->description = $request->description;}
    if ($request->has('salary_range')) {
        $job->salary_range = $request->salary_range;}
    if ($request->has('job_type')) {
        $job->job_type = $request->job_type;}
    if ($request->has('location')) {
        $job->location = $request->location;}
    if ($request->has('status')) {
        $job->status = $request->status;
    if ($request->has('is_premium')) {
        $job->is_premium = $request->is_premium;}

    }


    $job->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $job,
    ], 200);
}
}
