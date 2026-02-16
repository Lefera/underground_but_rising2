<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Derniers artistes
        |--------------------------------------------------------------------------
        */
        $artists = Artist::select('id', 'name', 'slug', 'photo')
            ->latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Genres
        |--------------------------------------------------------------------------
        */
        $genres = Genre::select('id', 'name', 'slug')->get();


        /*
        |--------------------------------------------------------------------------
        | News
        |--------------------------------------------------------------------------
        */
        $news = News::select('id', 'title', 'slug', 'image', 'created_at')
            ->latest()
            ->take(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ⭐ Artistes en vedette (Rising)
        | utilise le scope ->rising()
        |--------------------------------------------------------------------------
        */
        $featuredArtists = Artist::rising()
            ->orderByDesc('followers_count')
            ->take(4)
            ->get();


        return view('front.home', compact(
            'artists',
            'genres',
            'news',
            'featuredArtists'
        ));
    }
}
