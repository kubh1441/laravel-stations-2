<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Sheet;
use App\Models\Schedule;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request, Movie $movies)
    {
        $is_showing = $request->input('is_showing');
        $keyword = $request->input('keyword');

        return view('index', ['movies' => $movies->filterByParameters($is_showing, $keyword)]);
    }

    public function sheets(Sheet $sheets)
    {
        $sheets = Sheet::all();

        return view('sheets', ['sheets' => $sheets, 'num_of_column' => $sheets->max('column')]);
    }

    public function detail($id)
    {
        $movie = Movie::find($id);
        $schedules = Schedule::where('movie_id', $id)->orderBy('start_time', 'asc')->get();
        
        return view('detail', ['movie' => $movie, 'schedules' => $schedules]);
    }
}