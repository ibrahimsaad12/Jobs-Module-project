<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostSkillUserRequest;
use App\Models\User;
use App\Models\Skill;


    class SkillUserController extends Controller
    {
        public function attachSkill(Request $request, $userId)
        {
            $request->validate([
                'skill_id' => 'required|exists:skills,id',
            ]);

            $user = User::findOrFail($userId);
            $user->skills()->attach($request->skill_id);

            return response()->json(['message' => 'Skill attached successfully.']);
        }

        public function detachSkill(Request $request, $userId)
        {
            $request->validate([
                'skill_id' => 'required|exists:skills,id',
            ]);

            $user = User::findOrFail($userId);
            $user->skills()->detach($request->skill_id);

            return response()->json(['message' => 'Skill detached successfully.']);
        }

        public function listSkills($userId)
        {
            $user = User::findOrFail($userId);
            return response()->json($user->skills);
        }
        public function updateSkills(Request $request, $userId)
{
    $request->validate([
        'skill_ids' => 'required|array',
        'skill_ids.*' => 'exists:skills,id',
    ]);

    $user = User::findOrFail($userId);

    // Sync the skills, this will attach new skills and detach the ones not in the array
    $user->skills()->sync($request->skill_ids);

    return response()->json(['message' => 'Skills updated successfully.']);
}
    }

