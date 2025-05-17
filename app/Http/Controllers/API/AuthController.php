<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\UserRequest;
class AuthController extends Controller
{
    use Notifiable, HasApiTokens;
    public function register(RegisterRequest $request)
    {


        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profile_photo' => $request->profile_photo,
            'bio' => $request->bio,
            'location' => $request->location,
            'resume' => $request->resume,
            'companyname' => $request->companyname,
            'companywebsite' => $request->companywebsite,

        ]);

        $user->save();

        $token = $user->createToken('authToken')->plainTextToken;




        return response()->json([
            'success' => true,
            'message' => 'Successfully created user!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(UserRequest $request)
{
    // Attempt to log the user in
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged in!',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    // Authentication failed
    return response()->json([
        'success' => false,
        'message' => 'Invalid credentials!',
    ], 401);
}

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out!',
        ], 200);
    }
}
