<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Sanctum login API
    public function loginUser(AuthRequest $request)
    {
        $user = User::where('name', $request->login)
            ->orWhere('email', $request->login)
            ->first();
        // match by username or email
        // print_r($data);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }
        $user->tokens()->delete();
        $token = $user->createToken($request->device_name)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function registerUser(StoreUserRequest $request)
    {
        $user = new UserController();
        return $user->store($request);
    }
}
