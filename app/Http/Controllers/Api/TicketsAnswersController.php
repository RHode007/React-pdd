<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketsAnswersRequest;
use App\Http\Requests\Api\UpdateTicketsAnswersRequest;
use App\Http\Resources\Api\TicketsAnswersResource;
use App\Models\Api\Tickets;
use App\Models\Api\TicketsAnswers;
use Illuminate\Http\JsonResponse;

class TicketsAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(TicketsAnswers::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTicketsAnswersRequest $request
     * @return JsonResponse|object
     */
    public function store(StoreTicketsAnswersRequest $request)
    {
        $TicketAnswer = TicketsAnswers::create($request->all());
        return (new TicketsAnswersResource($TicketAnswer))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param TicketsAnswers $ticketsAnswers
     * @return TicketsAnswersResource
     */
    public function show(TicketsAnswers $ticketsAnswers): TicketsAnswersResource
    {
        return new TicketsAnswersResource(TicketsAnswers::findOrFail($ticketsAnswers->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketsAnswersRequest $request
     * @param TicketsAnswers $ticketsAnswers
     * @return JsonResponse|object
     */
    public function update(UpdateTicketsAnswersRequest $request, TicketsAnswers $ticketsAnswers)
    {
        $t = TicketsAnswers::find($ticketsAnswers->id);
        $t->update($request->all());
        return (new TicketsAnswersResource($t))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketsAnswers $ticketsAnswers
     * @return JsonResponse
     */
    public function destroy(TicketsAnswers $ticketsAnswers): JsonResponse
    {
        Tickets::findOrFail($ticketsAnswers->id)->delete();
        return response()->json(null, 204);
    }
}
