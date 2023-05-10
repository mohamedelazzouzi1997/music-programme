<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Music;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Http\Request;

class GeneratoreController extends Controller
{
    //
    public function index(){

        $categories = Category::all();
        $artists = Artist::all();
        $Musics = Music::all();
        dd($filtered);
        $Category_List_duration = array();
        $Artist_List = array();

        foreach($categories as $category){

            $startTime = Carbon::parse($category->start_time);
            $finishTime = Carbon::parse($category->end_time);
            $totalDuration = $finishTime->diff($startTime)->format('%H:%I:%S');
            $Category_List_duration[$category->id] = $totalDuration;
        }

        foreach($artists as $asrtist){
            foreach($Category_List_duration as $key => $duration) {
                $filtered = $Musics->where('category_id', '=', 7);
            }
        }

        dd($Category_List_duration);
        return view('generatore.index');
    }
}