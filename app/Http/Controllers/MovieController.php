<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request, Movie $movies)
    {
        $is_showing = $request->input('is_showing');
        $keyword = $request->input('keyword');

        return view('index', ['movies' => $movies->filterByParameters($is_showing, $keyword)]);
    }

    public function sheets()
    {
        return view('');
    }

}