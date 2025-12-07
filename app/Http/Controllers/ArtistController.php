<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::select('id', 'name', 'slug', 'photo', 'genre_id')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.artists.index', compact('artists'));
    }

    public function show($slug)
    {
        $artist = Artist::where('slug', $slug)
            ->with(['genre', 'tracks'])
            ->firstOrFail();

        if(auth()->check()) {
            auth()->user()->load('followedArtists');
        }

        return view('front.artists.show', compact('artist'));
    }

    public function follow(Artist $artist)
    {
        $user = auth()->user();

        if (!$user->followedArtists()->where('artist_id', $artist->id)->exists()) {
            $user->followedArtists()->attach($artist->id);
        }

        return response()->json([
            'followers' => $artist->followers()->count()
        ]);
    }

    public function unfollow(Artist $artist)
    {
        auth()->user()->followedArtists()->detach($artist->id);

        return response()->json([
            'followers' => $artist->followers()->count()
        ]);
    }

    public function revelations(Request $request)
    {
        $genre = $request->input('genre');
        $genres = Genre::all(); // list dropdown

        // Top 10 Rising Stars (+100 abonnés)
        $artists = Artist::withCount('followers')
            ->when($genre, function ($query) use ($genre) {
                $query->where('genre_id', $genre);
            })
            ->having('followers_count', '>=', 100)
            ->orderByDesc('followers_count')
            ->take(10)
            ->get();

        // Nouveaux talents (0–20 abonnés)
        $newTalents = Artist::withCount('followers')
            ->when($genre, function ($query) use ($genre) {
                $query->where('genre_id', $genre);
            })
            ->having('followers_count', '<=', 20)
            ->orderByDesc('id')
            ->get();

        return view('front.artists.revelations', compact('artists', 'newTalents', 'genres', 'genre'));
    }
}
