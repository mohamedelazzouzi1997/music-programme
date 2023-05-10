<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $artists = Artist::all();
        return view('artists.index',compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $musics = Music::all();
        return view('artists.create',compact('musics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $validation = $request->validate([
            'name' => 'required',
        ]);

        $store = Artist::create([
            'name' => $request->name,
            'music_id' => [],
            'fixed_music_id' => [],
        ]);
        if($store)
            return to_route('artists.index')->with([
                'success' => 'Artist a été Ajouté Avec Succée',
            ]);
        else
            return to_route('artists.index')->with([
                'fail' => 'Something went Wrong',
            ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $artist = Artist::findOrFail($id);
        $musics = Music::all();


        return view('artists.edit',compact('artist','musics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'name' => 'required',
        ]);

        $artist = Artist::findOrFail($id)->update([
            'name' => $request->name,
            'music_id' => [],
            'fixed_music_id' => [],
        ]);
        if($artist)
            return to_route('artists.index')->with([
                'success' => 'Artist a été Modifié Avec Succée',
            ]);
        else
            return to_route('artists.index')->with([
                'fail' => 'Something went Wrong',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $artist = Artist::findOrFail($id)->delete();

        if($artist)
            return to_route('artists.index')->with([
                'success' => 'Artist a été supprimé Avec Succée',
            ]);
        else
            return to_route('artists.index')->with([
                'fail' => 'Something went Wrong',
            ]);
    }

    public function is_available(string $id){
        $artist = Artist::findOrFail($id);

        $artist->update([
            'is_available' => !$artist->is_available
        ]);

        if($artist)
            return to_route('artists.index')->with([
                'success' => 'Artist a été modifié Avec Succée',
            ]);
        else
            return to_route('artists.index')->with([
                'fail' => 'Something went Wrong',
            ]);

    }
}