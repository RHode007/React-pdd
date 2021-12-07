<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUserTicketResultRequest;
use App\Http\Requests\Api\UpdateUserTicketResultRequest;
use App\Http\Resources\Api\UserTicketResultResource;
use App\Models\Api\UserTicketResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserTicketResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(UserTicketResult::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserTicketResultRequest $request
     * @return JsonResponse|object
     */
    public function store(StoreUserTicketResultRequest $request)
    {
        $UserTicketResult = UserTicketResult::create($request->all());
        return (new UserTicketResultResource($UserTicketResult))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param UserTicketResult $userTicketResult
     * @return UserTicketResultResource
     */
    public function show(UserTicketResult $userTicketResult): UserTicketResultResource
    {
        return new UserTicketResultResource(UserTicketResult::findOrFail($userTicketResult->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserTicketResultRequest $request
     * @param UserTicketResult $userTicketResult
     * @return JsonResponse|object
     */
    public function update(UpdateUserTicketResultRequest $request, UserTicketResult $userTicketResult)
    {
        $utr = UserTicketResult::find($userTicketResult->id);
        $utr->update($request->all());
        return (new UserTicketResultResource($utr))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserTicketResult $userTicketResult
     * @return JsonResponse
     */
    public function destroy(UserTicketResult $userTicketResult)
    {
        UserTicketResult::findOrFail($userTicketResult->id)->delete();
        return response()->json(null, 204);
    }
}
