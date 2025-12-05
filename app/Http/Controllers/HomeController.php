<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // Derniers artistes publiés (limite 6)
        $artists = Artist::select('id', 'name', 'slug', 'photo')
            ->latest()
            ->take(6)
            ->get();

        // Tous les genres (nom + slug seulement)
        $genres = Genre::select('id', 'name', 'slug')->get();

        // Dernières actualités (limite 3)
        $news = News::select('id', 'title', 'slug', 'image', 'created_at')
            ->latest()
            ->take(3)
            ->get();

        return view('front.home', compact('artists', 'genres', 'news'));
    }
}
