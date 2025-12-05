<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtistApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'genre_id' => 'required|integer|exists:genres,id'
        ]);

        $validated['slug'] = Str::slug($request->name);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('artists', 'public');
        }

        $artist = Artist::create($validated);

        return response()->json([
            'message' => 'Artiste créé avec succès',
            'artist' => $artist
        ]);
    }
}
