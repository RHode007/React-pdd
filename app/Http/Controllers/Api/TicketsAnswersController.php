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
            ->response();
    }

    /**
     * Display the specified resource.
     *
     * @param TicketsAnswers $ticketsanswers
     * @return TicketsAnswersResource
     */
    public function show(TicketsAnswers $ticketsanswers): TicketsAnswersResource
    {
        return new TicketsAnswersResource(TicketsAnswers::findOrFail($ticketsanswers->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketsAnswersRequest $request
     * @param TicketsAnswers $ticketsanswers
     * @return JsonResponse|object
     */
    public function update(UpdateTicketsAnswersRequest $request, TicketsAnswers $ticketsanswers)
    {
        $t = TicketsAnswers::find($ticketsanswers->id);
        $t->update($request->all());
        return (new TicketsAnswersResource($t))
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketsAnswers $ticketsanswers
     * @return JsonResponse
     */
    public function destroy(TicketsAnswers $ticketsanswers): JsonResponse
    {
        return response()->json(['message' => TicketsAnswers::findOrFail($ticketsanswers->id)->delete()?'successful':'fail']);
    }
}
