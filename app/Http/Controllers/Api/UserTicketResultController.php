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
            ->response();
    }

    /**
     * Display the specified resource.
     *
     * @param UserTicketResult $userticketresult
     * @return UserTicketResultResource
     */
    public function show(UserTicketResult $userticketresult): UserTicketResultResource
    {
        return new UserTicketResultResource(UserTicketResult::findOrFail($userticketresult->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserTicketResultRequest $request
     * @param UserTicketResult $userticketresult
     * @return JsonResponse|object
     */
    public function update(UpdateUserTicketResultRequest $request, UserTicketResult $userticketresult)
    {
        $utr = UserTicketResult::find($userticketresult->id);
        $utr->update($request->all());
        return (new UserTicketResultResource($utr))
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserTicketResult $userticketresult
     * @return JsonResponse
     */
    public function destroy(UserTicketResult $userticketresult)
    {
        return response()->json(['message' => UserTicketResult::findOrFail($userticketresult->id)->delete()?'successful':'fail']);
    }
}
