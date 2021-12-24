<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketsRequest;
use App\Http\Requests\Api\StoreUserTicketResultRequest;
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
        return response()->json(Tickets::paginate((Request::capture()->per_page) ?: 20)); //TODO in future, move per_page in admin page
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

        return (new TicketsResource($ticket))->response();
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
        return (new TicketsResource($t))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tickets $ticket
     * @return JsonResponse
     */
    public function delete(Tickets $ticket): JsonResponse
    {
        return response()->json(['message' => Tickets::findOrFail($ticket->id)->delete()?'successful':'fail']);
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

    /**
     * @param StoreUserTicketResultRequest $request
     * @return JsonResponse|object
     */
    public function answer(StoreUserTicketResultRequest $request)
    {

        //TODO findOrCreate
        return (new UserTicketResultController())->store($request);
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return response()->json(Tickets::all());
    }

    /**
     * @return JsonResponse
     */
    public function getRandom(): JsonResponse
    {
        return response()->json(Tickets::inRandomOrder()->limit(5)->get());
    }

}
