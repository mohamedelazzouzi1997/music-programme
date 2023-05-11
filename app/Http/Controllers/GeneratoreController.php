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

        $Category_List_duration = array();
        $Generated_Music_Ids = array();
        $Music_by_category_list = array();

        foreach($categories as $category){

            $startTime = Carbon::parse($category->start_time);
            $finishTime = Carbon::parse($category->end_time);
            $totalDuration = $finishTime->diff($startTime)->format('%H:%I:%S');
            $Category_List_duration[$category->id] = $totalDuration;
        }

        foreach($Category_List_duration as $category_id => $category_duration){

                $Musics_By_Category = Music::where('category_id',$category_id)->get();
                $category_name = Category::where('id',$category_id)->first()->name;
            // dd($Musics_By_Category);
            $all_seconds = 0;
            foreach ($Musics_By_Category as $Music) {
                list($hour, $minute, $second) = explode(':', $Music->time);
                // dd($hour);
                $all_seconds += $hour * 3600;
                $all_seconds += $minute * 60;
                $all_seconds += $second;
                $total_minutes = floor($all_seconds/60);
                $seconds = $all_seconds % 60;
                $hours = floor($total_minutes / 60);
                $minutes = $total_minutes % 60;
                $timestamp1 = $hours.':'. $total_minutes.':'. $second;
                if (Carbon::parse($timestamp1)->gt(Carbon::parse('01:00:00'))) {
                    break;
                } else {
                    $Generated_Music_Ids[] = $Music->id;
                }
            }
            $Music_by_category_list[$category_name] = $Generated_Music_Ids;
        }
        dd($Music_by_category_list);

        return view('generatore.index');
    }

}
