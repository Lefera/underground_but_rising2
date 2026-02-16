<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    /**
     * Formulaire création track
     */
    public function create(Artist $artist)
    {
        return view('tracks.create', compact('artist'));
    }

    /**
     * Enregistrer un nouveau track
     */
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

        /*
        |--------------------------------------------------------------------------
        | Upload audio
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('audio_file')) {

            $file = $request->file('audio_file');

            $filename = time().'_'.Str::random(10).'.'.$file->extension();

            $path = $file->storeAs('audios', $filename, 'public');

            $track->audio_file = $path;
        }

        $track->save();

        /*
        |--------------------------------------------------------------------------
        | Redirection propre via SLUG automatique
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('artists.show', $artist) // slug auto
            ->with('success', 'Track ajouté avec succès.');
    }
}
