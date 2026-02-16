<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;

class RevelationController extends Controller
{
    public function index(Request $request)
    {
        $genreId = $request->get('genre');


        /*
        |--------------------------------------------------------------------------
        | ⭐ TOP RÉVÉLATIONS
        |--------------------------------------------------------------------------
        */
        $artists = Artist::rising()
            ->when($genreId, fn($q) => $q->where('genre_id', $genreId))
            ->orderByDesc('followers_count')
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | 🌱 NOUVEAUX TALENTS
        |--------------------------------------------------------------------------
        */
        $newTalents = Artist::newTalents()
            ->when($genreId, fn($q) => $q->where('genre_id', $genreId))
            ->latest()
            ->take(12)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Genres (filtres)
        |--------------------------------------------------------------------------
        */
        $genres = Genre::orderBy('name')->get();


        return view('front.artists.revelations', compact(
            'artists',
            'newTalents',
            'genres',
            'genreId'
        ));
    }
}
