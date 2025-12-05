@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>Underground But Rising</h1>
        <p>Découvre et soutiens les artistes souterrains en pleine ascension.</p>
        <a class="btn" href="{{ route('artists.index') }}">Découvrir les artistes</a>
    </div>
</section>

<!-- ARTISTES À LA UNE -->
<section class="section">
    <h2 class="section-title">Artistes à la une</h2>

    <div class="artists-grid">
        @forelse($artists as $artist)
            <div class="artist-card">
                <img src="{{ asset('storage/artists' . $artist->photo) }}" alt="{{ $artist->name }}">
                <h3>{{ $artist->name }}</h3>
                <p>{{ $artist->genre->name ?? 'Genre non défini' }}</p>
                <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">Voir le profil</a>
            </div>
        @empty
            <p style="color:white;text-align:center;">Aucun artiste disponible pour le moment.</p>
        @endforelse
    </div>
</section>

<!-- GENRES -->
<section class="section">
    <h2 class="section-title">Genres musicaux</h2>

    <div class="genres-grid">
        @forelse($genres as $genre)
            <div class="genre-card">
                <p>{{ $genre->name }}</p>
            </div>
        @empty
            <p style="color:white;text-align:center;">Aucun genre disponible.</p>
        @endforelse
    </div>
</section>

<!-- ACTUALITÉS -->
<section class="section">
    <h2 class="section-title">Actualités récentes</h2>

    <div class="news-grid">
        @forelse($news as $item)
            <div class="news-card">
                <img src="{{ asset('storage/artists' . $item->photo) }}" alt="{{ $item->title }}">
                <h3>{{ $item->title }}</h3>
                <a href="{{ route('news.show', $item->slug) }}" class="btn-small">Lire plus</a>
            </div>
        @empty
            <p style="color:white;text-align:center;">Aucune actualité disponible pour le moment.</p>
        @endforelse
    </div>
</section>

@endsection
