<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Liste des artistes
    |--------------------------------------------------------------------------
    */

    public function search(Request $request)
{
    $q = $request->input('q');

    $artists = Artist::where('name', 'like', "%$q%")
                ->orWhere('bio', 'like', "%$q%")
                ->paginate(12);

    return view('artists.index', compact('artists', 'q'));
}
   public function index(Request $request)
{
    $q = $request->q;

    $artists = Artist::when($q, function ($query) use ($q) {
        $query->where('name', 'like', "%$q%")
              ->orWhere('bio', 'like', "%$q%");
    })
    ->latest()
    ->paginate(12);

    return view('front.artists.index', compact('artists', 'q'));
}


    /*
    |--------------------------------------------------------------------------
    | Profil artiste
    |--------------------------------------------------------------------------
    */
    public function show(Artist $artist)
    {
        $artist->load('tracks', 'genre')->loadCount('followers');

        return view('front.artists.show', compact('artist'));

        $artist->increment('views');

    return view('artists.show', compact('artist'));


    // compteur vues
    $artist->increment('views');

    $artist->load([
        'genre',
        'tracks',
        'followers'
    ]);

    return view('artists.show', compact('artist'));
    }


    /*
    |--------------------------------------------------------------------------
    | Follow
    |--------------------------------------------------------------------------
    */
    public function follow(Artist $artist)
    {
        auth()->user()
            ->followedArtists()
            ->syncWithoutDetaching($artist->id);

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | Unfollow
    |--------------------------------------------------------------------------
    */
    public function unfollow(Artist $artist)
    {
        auth()->user()
            ->followedArtists()
            ->detach($artist->id);

        return back();
    }

    
}
