<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\UserController;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    // Sanctum login API
    public function loginUser(AuthRequest $request) //TODO snakecase?
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user= User::where('name', $request->login)
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

    public function registerUser(StoreUserRequest $request) //TODO snakecase?
    {
        $user = new UserController();
        return response($user->store($request), 201);
    }
}
