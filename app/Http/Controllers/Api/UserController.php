<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse|object
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60),
        ]);
        $user->tokens()->delete();
        $token = $user->createToken($request->device_name)->plainTextToken;
        /*$response = [
            'user' => $user,
            'token' => $token
        ];*/
        return (new UserResource($user))->response()->setStatusCode(201);
        //return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource(User::findOrFail($user->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse|object
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $u = User::find($user->id);
        if ($request->request->has('api_token')) {
            $request['api_token'] = Str::random(60);
        }
        $u->update($request->all());

        /*$response = [
            'user' => $u
        ];*/

        return (new UserResource($u))->response()->setStatusCode(201);
        //return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        User::findOrFail($user->id)->delete();
        return response()->json(null, 204);
    }
}
