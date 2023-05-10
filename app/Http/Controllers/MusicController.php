<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $musics = Music::all();
        return view('music.index',compact('musics'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $artists = Artist::all();
        return view('music.create',compact('categories','artists'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validation = $request->validate([
            'name' => 'required',
            'time' => 'required',
            'category_id' => 'required',
            'artist_id' => 'required'
        ]);

        $store = Music::create($validation);

        //store manytomany relationship artistMusic table
        $store->artists()->attach($request->artist_id);


        if($store)
            return to_route('musics.index')->with([
                'success' => 'Music a été Ajouté Avec Succée',
            ]);
        else
            return to_route('musics.index')->with([
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
        $categories = Category::all();
        $music = Music::findOrFail($id);
        $artists = Artist::all();

        return view('music.edit',compact('music','categories','artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $validation = $request->validate([
            'name' => 'required',
            'time' => 'required',
            'category_id' => 'required',
            'artist_id' => 'required'
        ]);

        $music = Music::findOrFail($id);
        $music->artists()->sync($request->artist_id);
        $music->update($validation);

        if($music)
            return to_route('musics.index')->with([
                'success' => 'Music a été Modifié Avec Succée',
            ]);
        else
            return to_route('musics.index')->with([
                'fail' => 'Something went Wrong',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $music = Music::findOrFail($id);

        $music->artists()->detach();
        $music->delete();

        if($music)
            return to_route('musics.index')->with([
                'success' => 'Music a été supprimé Avec Succée',
            ]);
        else
            return to_route('musics.index')->with([
                'fail' => 'Something went Wrong',
            ]);
    }
}