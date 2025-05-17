<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class JobUserController extends Controller{


public function attachJob(Request $request, $userId)
{
    $request->validate([
        'job_id' => 'required|exists:jobs,id',
    ]);

    $user = User::findOrFail($userId);
    $user->jobs()->attach($request->job_id);

    return response()->json(['message' => 'Job attached successfully.']);
}

public function detachJob(Request $request, $userId)
{
    $request->validate([
        'job_id' => 'required|exists:jobs,id',
    ]);

    $user = User::findOrFail($userId);
    $user->jobs()->detach($request->job_id);

    return response()->json(['message' => 'Job detached successfully.']);
}

public function listJobs($userId)
{
    $user = User::findOrFail($userId);
    return response()->json($user->jobs);
}

public function updateJobs(Request $request, $userId)
{
    $request->validate([
        'job_ids' => 'required|array',
        'job_ids.*' => 'exists:jobs,id',
    ]);

    $user = User::findOrFail($userId);

    // Sync the jobs, this will attach new jobs and detach the ones not in the array
    $user->jobs()->sync($request->job_ids);

    return response()->json(['message' => 'Jobs updated successfully.']);
}
}
