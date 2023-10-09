<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthTokensController extends Controller
{

    public function index(Request $request)
    {
        return $request->user()->tokens;
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($request->device_name, ['project.update', 'project.create']);

            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,

            ], 201);
        }

        return response()->json([
            'message' => 'invalid credentials'
        ], 401);
    }

    public function delete()
    {
        $user = Auth::guard('sanctum')->user();
        // $user->tokens()->findOrFail($id)->delete() ;

        $user->currentAccessToken()->delete();



        return response()->json([
            'message' => 'Token Deleted'
        ]);
    }
}
