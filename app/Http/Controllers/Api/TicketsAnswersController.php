<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketsAnswersRequest;
use App\Http\Requests\Api\UpdateTicketsAnswersRequest;
use App\Http\Resources\Api\TicketsAnswersResource;
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
     * @param TicketsAnswers $ticketsanswer
     * @return TicketsAnswersResource
     */
    public function show(TicketsAnswers $ticketsanswer): TicketsAnswersResource
    {
        return new TicketsAnswersResource(TicketsAnswers::findOrFail($ticketsanswer->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketsAnswersRequest $request
     * @param TicketsAnswers $ticketsanswer
     * @return JsonResponse|object
     */
    public function update(UpdateTicketsAnswersRequest $request, TicketsAnswers $ticketsanswer)
    {
        $t = TicketsAnswers::find($ticketsanswer->id);
        $t->update($request->all());
        return (new TicketsAnswersResource($t))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketsAnswers $ticketsanswers
     * @return JsonResponse
     */
    public function destroy(TicketsAnswers $ticketsanswers): JsonResponse
    {
        TicketsAnswers::findOrFail($ticketsanswers->id)->delete();
        return response()->json(null, 204);
    }
}
