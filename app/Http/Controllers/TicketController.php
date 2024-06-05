<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

use Illuminate\Http\Request;

use App\Http\Middleware\IsAdmin;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreTicketRequest;

use App\Http\Requests\UpdateTicketRequest;

use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Routing\Controllers\HasMiddleware;

//Nuova interfaccia per usare i middleware nei controller

//https://laravel.com/docs/11.x/controllers#controller-middleware

class TicketController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('is_admin', only: ['destroy']), 
            //'is_admin' è l'alias del custom middleware
            
            // L'alias si definisce all'interno del file bootstrap/app.php

            //https://laravel.com/docs/11.x/middleware#registering-middleware
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'DESC')->get();
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
        if($ticket->status!=0){
            abort(403);
        }
        
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        if($ticket->status!=0){
            abort(403);
        }
        
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
        if($ticket->status!=0){
            abort(403);
        }
        
        if($ticket->image){
            Storage::delete($ticket->image);
        }
        
        $ticket->delete();

        return redirect()->back()->with(['success'=>'Ticket eliminato con successo']);
    }

    public function closeTicket(Ticket $ticket){
        
        $ticket->status=2;
        $ticket->save();

        return redirect()->back()->with(['success'=>'Ticket chiuso con successo']);
    }
}
