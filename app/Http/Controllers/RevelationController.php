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

        // TOP 10 artistes les plus suivis
        $artists = Artist::withCount('followers')
            ->when($genreId, function($query) use ($genreId) {
                $query->where('genre_id', $genreId);
            })
            ->orderByDesc('followers_count')
            ->take(10)
            ->get();

        // Nouveaux talents : 0 à 20 abonnés
        $newTalents = Artist::withCount('followers')
            ->whereBetween('followers_count', [0, 20])
            ->orderByDesc('id')
            ->take(12)
            ->get();

        // Liste des genres pour filtre
        $genres = Genre::all();

        return view('revelations', [
            'artists' => $artists,
            'newTalents' => $newTalents,
            'genres' => $genres,
            'genre' => $genreId
        ]);
    }
}
