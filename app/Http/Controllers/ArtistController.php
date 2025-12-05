<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * Liste des artistes (pages publiques)
     */
    public function index()
    {
        $artists = Artist::all();
        return view('front.artists.index', compact('artists'));
    }

    /**
     * Affichage d'un artiste par slug (page publique)
     */
    public function show(Artist $artist)
    {
        return view('front.artists.show', compact('artist'));
    }

    /**
     * Création d’un artiste via API uniquement (admin)
     */
    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Accès refusé : vous n’êtes pas administrateur.'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio'  => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'genre_id' => 'required|integer|exists:genres,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('artists', 'public');
        $artist->photo = $photoPath;
    }

        $artist = Artist::create($validated);

        return response()->json([
            'message' => 'Artiste créé avec succès',
            'artist'  => $artist
        ], 201);
    }
}
