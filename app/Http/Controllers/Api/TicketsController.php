<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketsResource;
use App\Models\Tickets;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index()
    {
        return response()->json(Tickets::all());
    }

    public function show($id)
    {
        return new TicketsResource(Tickets::findOrFail($id));
    }

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

    public function delete($id)
    {
        $tickets = Tickets::findOrFail($id);
        $tickets->delete();

        return response()->json(null, 204);
    }

    public function resetAnswers($id)
    {
        $tickets = Tickets::findOrFail($id);
        $tickets->answers = 0;
        $tickets->points = 0;

        return new TicketsResource($tickets);
    }
}
