<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Sanctum login API
    public function loginUser(AuthRequest $request)
    {
        $user = User::where('name', $request->login)
            ->orWhere('email', $request->login)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }
        Auth::login($user);
        $user['token'] = $user->createToken($request->device_name)->plainTextToken;

        return (new UserResource($user))->response();
    }

    public function registerUser(StoreUserRequest $request)
    {
        return (new UserController())->store($request);
    }
}
