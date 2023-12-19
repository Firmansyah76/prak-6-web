<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showAllUsers(AuthController $request)
    {
        try {
            $user = User::all();

            return response()->json([
                "message" => "Success",
                "data" => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function getUserById(AuthRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                "message" => "Success",
                "data" => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function updateUserById(AuthRequest $request, $id)
{
    try {
        $user = User::findOrFail($id);

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);

        return response()->json([
            "message" => "User updated successfully",
            "data" => $user
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}
    public function register(AuthRequest $request) {
        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);

            return response()->json([
                "message" => "Success",
                "data" => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }

    public function login(AuthRequest $request) {
        try {
            $user = User::where("email", $request->email)->first();
            if($user) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    "message" => "Success",
                    "token_type" => "Bearer",
                    "access_token" => $token
                ], 200);
            } else {
                return response()->json([
                    "message" => "Failed",
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                $user->delete();
                return response()->json(['message' => 'User deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
}