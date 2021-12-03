<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketsResource;
use App\Models\Tickets;
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
     * @param $id
     * @return TicketsResource
     */
    public function show($id): TicketsResource
    {
        return new TicketsResource(Tickets::findOrFail($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse|object
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $player = Tickets::create($request->all());

        return (new TicketsResource($player))
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
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $tickets = Tickets::findOrFail($id);
        $tickets->delete();

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
