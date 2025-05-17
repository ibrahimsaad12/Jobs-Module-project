<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostSkillRequest;
use App\Models\Skill;
use App\Http\Requests\UpdateSkillRequest;

class SkillController extends Controller
{

        public function index()
        {
            $skill = Skill::all();

            return response()->json([
                'success' => true,
                'data' => $skill,

            ], 200);
        }

        public function post(PostSkillRequest $request)
        {
            $skill = new Skill([
                'name' => $request->name,
            ]);
            $skill->save();

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!',
            'data' => $skill,
        ], 201);

    }
    public function destroy($id)
{
    $skill = Skill::find($id);

    if (!$skill) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    $skill->delete();

    return response()->json([
        'success' => true,
        'message' => 'Application deleted successfully!',
    ], 200);
}
public function update(UpdateSkillRequest $request, $id)
{
    $skill = Skill::find($id);
// Debugging: Log the incoming request data

    if (!$skill) {
        return response()->json([
            'success' => false,
            'message' => 'Application not found!',
        ], 404);
    }

    // Update only the fields that are present in the request
    if ($request->name) {
        $skill->name = $request->name;
    }


    $skill->save();

    return response()->json([
        'success' => true,
        'message' => 'Application updated successfully!',
        'data' => $skill,
    ], 200);
}
}

