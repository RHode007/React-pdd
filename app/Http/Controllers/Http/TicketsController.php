<?php

namespace App\Http\Controllers\Http;

use App\Http\Controllers\Controller;
use App\Models\Api\Tickets;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Tickets::all();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text'=>'required',
            'status'=>'required',
        ]);

        $tickets = new Tickets([
            'text' => $request->get('text'),
            'status' => $request->get('status'),
            'attachments' => $request->get('attachments')
        ]);
        $tickets->save();

        return redirect('/tickets')->with('success', 'TicketsResource saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tickets.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $tickets = Tickets::find($id);

        return view('tickets.edit', compact('tickets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'text'=>'required',
            'status'=>'required',
        ]);

        $tickets = Tickets::find($id);
        $tickets->text =  $request->get('text');
        $tickets->status = $request->get('status');
        $tickets->attachments = $request->get('attachments');
        $tickets->save();

        return redirect('/tickets')->with('success', 'TicketsResource updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tickets = Tickets::find($id);
        $tickets->delete();

        return redirect('/tickets')->with('success', 'TicketsResource deleted!');
    }
}
