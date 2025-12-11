<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    /**
     * Liste des artistes (Page principale artistes)
     */
    public function index()
    {
        $artists = Artist::select('id', 'name', 'slug', 'photo', 'genre_id')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.artists.index', compact('artists'));
    }

    /**
     * Page profil d'un artiste
     */
    public function show($slug)
    {
        $artist = Artist::where('slug', $slug)
            ->with([
                'genre',
                'tracks'
            ])
            ->withCount('followers')
            ->firstOrFail();

        // Vérifier si l'utilisateur connecté suit déjà cet artiste
        if (auth()->check()) {
            auth()->user()->load('followedArtists');
        }

        return view('front.artists.show', compact('artist'));
    }

    /**
     * Suivre un artiste
     */
    public function follow(Artist $artist)
    {
        $user = auth()->user();

        if (!$user->followedArtists()->where('artist_id', $artist->id)->exists()) {
            $user->followedArtists()->attach($artist->id);
        }

        return redirect()->back()->with('success', 'Vous êtes maintenant abonné à cet artiste.');
    }

    /**
     * Se désabonner d'un artiste
     */
    public function unfollow(Artist $artist)
    {
        auth()->user()->followedArtists()->detach($artist->id);

        return redirect()->back()->with('success', 'Vous vous êtes désabonné.');
    }

    /**
     * Page Révélations : artistes en évolution
     */
    public function revelations(Request $request)
    {
        $genre = $request->input('genre');
        $genres = Genre::all();

        // Top 10 Rising Stars (+100 abonnés)
        $artists = Artist::withCount('followers')
            ->when($genre, fn($query) => $query->where('genre_id', $genre))
            ->having('followers_count', '>=', 100)
            ->orderByDesc('followers_count')
            ->take(10)
            ->get();

        // Nouveaux talents (0–20 abonnés)
        $newTalents = Artist::withCount('followers')
            ->when($genre, fn($query) => $query->where('genre_id', $genre))
            ->having('followers_count', '<=', 20)
            ->orderByDesc('id')
            ->get();

        return view('front.artists.revelations', compact('artists', 'newTalents', 'genres', 'genre'));
    }

    /**
     * Barre de recherche artistes + genres
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $artists = Artist::where('name', 'LIKE', '%' . $query . '%')
            ->orWhereHas('genre', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->paginate(12);

        return view('front.artists.search-results', compact('artists', 'query'));
    }

    /**
     * Mise à jour de la photo de profil d’un artiste
     */
    public function updatePhoto(Request $request, Artist $artist)
    {
        // 1. Validation du fichier image
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // 2. Suppression ancienne photo si existe
        if ($artist->photo) {
            Storage::delete('artists/' . $artist->photo);
        }

        // 3. Enregistrement nouvelle image
        $filename = time() . '.' . $request->photo->extension();
        $request->photo->storeAs('artists', $filename);

        // 4. Mise à jour de la base
        $artist->update(['photo' => $filename]);

        return back()->with('success', 'Photo de profil mise à jour avec succès.');
    }
}
