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
            'duration' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $request->image->move(public_path('images'), $imageName);
        // }
        // Simpan gambar ke server
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar di direktori 'storage/app/public/images'
        }

        //fungsi simpan data ke dalam database
        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration,
            'image' => $imagePath,
            // 'image' => $request->image
        ]);

        // if ($request->hasFile('image')) {
        //     $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
        //     $data->image = $request->file('image')->getClientOriginalName();
        //     $data->save();
        // }

        try {
            return redirect()->route('movie.index');
        } catch (Exception $e) {
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
            'duration' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar di direktori 'storage/app/public/images'
        }

        $movie->update([
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration,
            'image' => $imagePath,
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
