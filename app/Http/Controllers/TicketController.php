<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Tickets = Ticket::get();

        return view('ticket.index', compact('Tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {

        $ticket = Ticket::create([
            'title' =>  $request->title,
            'description' =>  $request->description,
            'user_id' => auth()->id(),

        ]);
        if ($request->file('attachment')) {
            $this->Storeattachment($request, $ticket);
        }


        // return response()->redirect(route('ticket.index'));

        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // $Ticket = Ticket::findOrFail($ticket);
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {

        $ticket->update($request->validated());
        if ($file = $request->file('attachment')) {
            Storage::delete('attachments/');
            $this->Storeattachment($request, $ticket);
        }
        // return response()->redirect(route('ticket.index'));

        return redirect()->route('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }
    protected function Storeattachment($request, $ticket)
    {
        $file = $request->file('attachment');
        $destinationPath = 'attachments/';
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $profileImage);
        $ticket->update(['attachment' => $profileImage]);
    }
}
