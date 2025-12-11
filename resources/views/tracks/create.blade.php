@extends('layouts.app')

@section('content')
<div class="form-container">

    <h1>Ajouter un Track à {{ $artist->name }}</h1>

    <form action="{{ route('tracks.store', $artist->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Titre du track</label>
        <input type="text" name="title" required>

        <label>Lien YouTube (optionnel)</label>
        <input type="text" name="youtube_link">

        <label>Fichier audio (MP3/WAV/OGG)</label>
        <input type="file" name="audio_file" accept="audio/*">

        <button type="submit">Ajouter</button>
    </form>

</div>
@endsection
