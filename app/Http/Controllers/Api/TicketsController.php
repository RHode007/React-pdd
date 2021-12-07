<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketsRequest;
use App\Http\Requests\Api\UpdateTicketsRequest;
use App\Http\Resources\Api\TicketsResource;
use App\Models\Api\Tickets;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Tickets::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Tickets $ticket
     * @return TicketsResource
     */
    public function show(Tickets $ticket): TicketsResource
    {
        return new TicketsResource(Tickets::findOrFail($ticket->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTicketsRequest $request
     * @return JsonResponse|object
     */
    public function store(StoreTicketsRequest $request)
    {
        $ticket = Tickets::create($request->all());

        return (new TicketsResource($ticket))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketsRequest $request
     * @param Tickets $ticket
     * @return JsonResponse|object
     */
    public function update(UpdateTicketsRequest $request, Tickets $ticket)
    {
        $t=Tickets::find($ticket->id);
        $t->update($request->all());
        return (new TicketsResource($t))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return TicketsResource
     */
    public function answer($id, Request $request) //TODO rewrite
    {
        $request->merge(['correct' => (bool) json_decode($request->get('correct'))]);
        $request->validate([
            'correct' => 'required|boolean'
        ]);

        $tickets = Tickets::findOrFail($id);
        $tickets->answers++;
        $tickets->points = ($request->get('correct')
            ? $tickets->points + 1
            : $tickets->points - 1);
        $tickets->save();

        return new TicketsResource($tickets);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tickets $ticket
     * @return JsonResponse
     */
    public function delete(Tickets $ticket): JsonResponse
    {
        Tickets::findOrFail($ticket->id)->delete();
        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return TicketsResource
     */
    public function resetAnswers($id): TicketsResource
    {
        $tickets = Tickets::findOrFail($id);
        $tickets->answers = 0;
        $tickets->points = 0;

        return new TicketsResource($tickets);
    }
}
