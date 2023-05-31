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
    public function generatore(){
        $categories = Category::orderBy('category_order')->get();
        // $artists = Artist::all();
        $Musics = Music::all();

        $Category_List_duration = array();
        $Generated_Music_Ids = array();
        $Music_by_category_list = array();

        //callc the time of each category and store it in Category_List_duration array
        foreach($categories as $category){

            $startTime = Carbon::parse($category->start_time);
            $finishTime = Carbon::parse($category->end_time);

            $totalDuration = $finishTime->diff($startTime)->format('%H:%I:%S');
            $Category_List_duration[$category->id] = $totalDuration;
        }
        //loop through categories array
        foreach($Category_List_duration as $category_id => $category_duration){

                $Musics_By_Category = Music::where('category_id',$category_id)->inRandomOrder()->get();
                // dd($Musics_By_Category->pluck('id'));
                $category_name = Category::where('id',$category_id)->first()->name;
                $totalTime = Carbon::createFromTime(0, 0, 0);

            foreach ($Musics_By_Category as $Music) {
                $is_available = false;
                //check if artist available to add music
                foreach($Music->artist_id as $artist_id){
                    $artis = Artist::findOrfail($artist_id);
                    if($artis->is_available){
                        $is_available = true;
                        break;
                    }
                }

                // if artist available we add music to list

                if($is_available){
                    $timeParts = explode(':', $Music->time);
                    $hours = intval($timeParts[0]);
                    $minutes = intval($timeParts[1]);
                    $seconds = intval($timeParts[2]);

                    $totalTime->addHours($hours);
                    $totalTime->addMinutes($minutes);
                    $totalTime->addSeconds($seconds);


                    if (Carbon::parse($totalTime)->gt(Carbon::parse($category_duration))) {
                        $Generated_Music_Ids[] = $Music->id;
                        break;
                    } else {
                        $Generated_Music_Ids[] = $Music->id;
                    }
                }
            }

            $Music_by_category_list[$category_name] = $Generated_Music_Ids;
            $Generated_Music_Ids = array();
        dd(true);

        }

        dd($Music_by_category_list);

        return view('generatore.index',compact('Music_by_category_list'));
    }

}