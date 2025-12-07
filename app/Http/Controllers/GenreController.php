<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
public function index()
{
    $artists = Artist::paginate(12); // 12 artistes par page
    return view('front.artists.index', compact('artists'));
}


    public function show(Genre $genre)
    {
        return view('front.genres.show', compact('genre'));
    }
}
