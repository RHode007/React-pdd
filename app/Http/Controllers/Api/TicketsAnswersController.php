<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketsAnswersRequest;
use App\Http\Requests\Api\UpdateTicketsAnswersRequest;
use App\Http\Resources\Api\TicketsAnswersResource;
use App\Models\Api\Tickets;
use App\Models\Api\TicketsAnswers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class TicketsAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $ticket_id
     * @return JsonResponse
     */
    public function index($ticket_id): JsonResponse
    {
        return response()->json(TicketsAnswers::paginate(4));
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
        return (new TicketsAnswersResource($TicketAnswer))->response();
    }

    /**
     * Display the specified resource.
     *
     * @param $ticket_id
     * @param $id
     * @return TicketsAnswersResource
     */
    public function show($ticket_id, $id): TicketsAnswersResource
    {
        return new TicketsAnswersResource(TicketsAnswers::where('ticket_id','=',$ticket_id)->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $ticket_id
     * @param UpdateTicketsAnswersRequest $request
     * @param TicketsAnswers $ticketsanswers
     * @return JsonResponse|object
     */
    public function update($ticket_id, UpdateTicketsAnswersRequest $request, TicketsAnswers $ticketsanswers)
    {
        $t = TicketsAnswers::find($ticketsanswers->id);
        $t->update($request->all());
        return (new TicketsAnswersResource($t))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $ticket_id
     * @param TicketsAnswers $ticketsanswers
     * @return JsonResponse
     */
    public function destroy($ticket_id, TicketsAnswers $ticketsanswers): JsonResponse
    {
        return response()->json(['message' => TicketsAnswers::findOrFail($ticketsanswers->id)->delete()?'successful':'fail']);
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return response()->json(TicketsAnswers::all());
    }

    /**
     * @param $ticket_id
     * @return JsonResponse
     */
    public function getRandom($ticket_id): JsonResponse
    {
        return response()->json(TicketsAnswers::inRandomOrder()->where('ticket_id','=',$ticket_id)->limit(4)->get());
    }
}
