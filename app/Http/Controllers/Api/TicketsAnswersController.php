<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketsAnswersRequest;
use App\Http\Requests\Api\UpdateTicketsAnswersRequest;
use App\Models\Api\TicketsAnswers;

class TicketsAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\StoreTicketsAnswersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketsAnswersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\TicketsAnswers  $ticketsAnswers
     * @return \Illuminate\Http\Response
     */
    public function show(TicketsAnswers $ticketsAnswers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\TicketsAnswers  $ticketsAnswers
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketsAnswers $ticketsAnswers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UpdateTicketsAnswersRequest  $request
     * @param  \App\Models\Api\TicketsAnswers  $ticketsAnswers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketsAnswersRequest $request, TicketsAnswers $ticketsAnswers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\TicketsAnswers  $ticketsAnswers
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketsAnswers $ticketsAnswers)
    {
        //
    }
}
