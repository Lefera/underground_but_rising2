@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Ajouter une œuvre pour {{ $artist->name }}</h2>

    <form action="{{ route('tracks.store', $artist) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Titre</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Lien YouTube (optionnel)</label>
            <input type="text" name="youtube_link">
        </div>

        <div>
            <label>Fichier audio (mp3, wav…)</label>
            <input type="file" name="audio_file">
        </div>

        <button type="submit">Enregistrer</button>
    </form>
</div>

@endsection
