<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;


class ApplicationController extends Controller
{
    public function index()
    {
        $application = Application::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched posts!',
            'data' => $application,
        ], 200);
    }

    public function post(PostApplicationRequest $request)
{
    $application = new Application([
        'job_id' => $request->job_id,
        'user_id' => $request->user_id,
        'cover_letter' => $request->cover_letter,
        'resume' => $request->file('resume')->store('resumes'), // Store the resume file
        'status' => $request->status,
    ]);

    $application->save();

    return response()->json([
        'success' => true,
        'message' => 'Application submitted successfully!',
        'data' => $application,
    ], 201);

}
public function destroy($id)
{
    $application = Application::find($id);

    if (!$application) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $application->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}

public function update(UpdateApplicationRequest $request, $id)
{
    $application = Application::find($id);
// Debugging: Log the incoming request data

    if (!$application) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
    if ($request->has('job_id')) {
        $application->job_id = $request->job_id;
    }
    if ($request->has('user_id')) {
        $application->user_id = $request->user_id;
    }
    if ($request->has('cover_letter')) {
        $application->cover_letter = $request->cover_letter;
    }
    if ($request->hasFile('resume')) {
        // Store the new resume file and update the path
        $application->resume = $request->file('resume')->store('resumes');
    }
    if ($request->has('status')) {
        $application->status = $request->status;
    }

    $application->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $application,
    ], 200);
}
}



