<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validation = $request->validate([
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'category_order' => 'required'
        ]);
        // dd($request);
        $store = Category::create($validation);
        if($store)
            return to_route('categories.index')->with([
                'success' => 'Category a été Ajouté Avec Succée',
            ]);
        else
            return to_route('categories.index')->with([
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
        $category = Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $validation = $request->validate([
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'category_order' => 'required'
        ]);

        $category = Category::findOrFail($id)->update($validation);
        if($category)
            return to_route('categories.index')->with([
                'success' => 'Category a été Modifié Avec Succée',
            ]);
        else
            return to_route('categories.index')->with([
                'fail' => 'Something went Wrong',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       //
        $category = Category::findOrFail($id)->delete();

        if($category)
            return to_route('categories.index')->with([
                'success' => 'Category a été supprimé Avec Succée',
            ]);
        else
            return to_route('categories.index')->with([
                'fail' => 'Something went Wrong',
            ]);
    }
}