<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreTicketRequest;

use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'object'=>$request->object,
            'description'=>$request->description,
        ]);

        if($request->hasFile('image')){
            $path=$request->file('image')->storeAs('public/tickets/' . $ticket->id, 'screenshot.jpg');
            $ticket->image=$path;
            $ticket->save();
        }

        return redirect()->back()->with(['success'=>'Ticket creato con successo']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update([
            'object'=>$request->object,
            'description'=>$request->description,
        ]);

        if($request->hasFile('image')){
            $path=$request->file('image')->storeAs('public/tickets/' . $ticket->id, 'screenshot.jpg');
            $ticket->image=$path;
            $ticket->save();
        }

        return redirect()->back()->with(['success'=>'Ticket modificato con successo']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        if($ticket->cover){
            Storage::delete($ticket->cover);
        }
        
        $ticket->delete();

        return redirect()->back()->with(['success'=>'Ticket eliminato con successo']);
    }
}
