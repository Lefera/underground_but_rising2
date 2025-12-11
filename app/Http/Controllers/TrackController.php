<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    public function create(Artist $artist)
    {
        return view('tracks.create', compact('artist'));
    }

    public function store(Request $request, Artist $artist)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_link' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:20000',
        ]);

        $track = new Track();
        $track->artist_id = $artist->id;
        $track->title = $request->title;
        $track->youtube_link = $request->youtube_link;

        // Upload audio si un fichier a été envoyé
        if ($request->hasFile('audio_file')) {
            $filename = time() . '_' . Str::random(10) . '.' . $request->audio_file->extension();
            $path = $request->audio_file->storeAs('audios', $filename, 'public');
            $track->audio_file = $path;
        }

        $track->save();

        return redirect()->route('artists.show', $artist->id)
                         ->with('success', 'Track ajouté avec succès.');
    }
}
