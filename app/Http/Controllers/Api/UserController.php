<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
        $request['password'] = Hash::make($request->password);
        $request['api_token'] = Str::random(60);
        $request['status'] = 0;

        $u = User::create($request->all());
        $u->tokens()->delete();
        $u['token'] = $u->createToken($request->device_name)->plainTextToken;

        Auth::login($u);
        $u['new_user']=true; //attribute for resource check
        return (new UserResource($u))->response();
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
        if ($request->request->has('password')) {
            $request['password'] = Hash::make($request->password);
        }
        if ($request->request->has('api_token')) {
            $request['api_token'] = Str::random(60);
        }
        $u->update($request->all());
        if ($request->request->has('device_name')) { //add token attribute after update or error
            $u->tokens()->delete();
            $u['token'] = $u->createToken($request->device_name)->plainTextToken;
        }
        /*if ($request->request->has('token')) { TODO change token
            $user->tokens()->delete();
            $token = $user->createToken($request->device_name)->plainTextToken;
            $request['token'] = $user->withAccessToken($token);
        }

        //$rtg=$user->tokens()->get();
        //$rtg=$user->tokens()->where('tokenenable_id','=','4'); //need to delete old where(tokenenable_id=curentUserToken)
        */


        return (new UserResource($u))->response();
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        return response()->json(['message' => User::findOrFail($user->id)->delete()?'successful':'fail']);
    }
}
