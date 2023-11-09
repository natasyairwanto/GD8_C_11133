<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Movie;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
        // @return void

    public function index()
    {
        //get ticket
        $ticket = Ticket::latest()->paginate(5);
        //render view with posts
        return view('ticket.index', compact('ticket'));
    }

    public function create()
    {
        $movies = Movie::all();
        return view('ticket.create', compact('movies'));
    }

    public function store(Request $request)
    {
    $validationRules = [
        'class' => 'required',
        'price' => 'required',
        'movie' => 'required',
    ];

    $message = [
        'class.required' => 'Class tidak boleh kosong !',
        'price.required' => 'Price tidak boleh kosong !',
        'movie.required' => 'Harus pilih salah satu movie !',
    ];

    $this->validate($request, $validationRules, $message);

    $ticket = Ticket::create([
        'id_movie' => $request->movie,
        'class' => $request->class,
        'price' => $request->price,
    ]);

    return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id)
    {
        $validationRules = [
            'class' => 'required',
            'price' => 'required',
            'movie' => 'required',
        ];

        $this->validate($request, $validationRules);

        $ticket = Ticket::find($id);

        $ticket->id_movie = $request->movie;
        $ticket->class = $request->class;
        $ticket->price = $request->price;
        $ticket->save();

        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $movies = Movie::all();
        return view('ticket.edit', compact('ticket', 'movies'));
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->route('ticket.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
