<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Movie;


class MovieController extends Controller
{
    //
        // @return void
    public function index()
    {
        //get movie
        $movie = Movie::latest()->paginate(5);
        //render view with posts
        return view('movie.index', compact('movie'));
    }

        // @return void
    public function create()
    {
        return view('movie.create');
    }

        // @param Request $request
        // @return void
    public function store(Request $request)
    {
        //validasi formulir
        $this->validate($request, [
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required'
        ]);

        //fungsi simpan data ke dalam database
        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration
        ]);

        try{
            return redirect()->route('movie.index');
        }catch(Exception $e){
            return redirect()->route('movie.index');
        }
    }

        // @param int $id
        // @return void

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movie.edit', compact('movie'));
    }

        // @param mixed $request
        // @param int $id
        // @return void

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        //validate form
        $this->validate($request, [
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required'
        ]);

        $movie->update([
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration
        ]);

        return redirect()->route('movie.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

        // @param int $id
        // @return void

    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect()->route('movie.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
