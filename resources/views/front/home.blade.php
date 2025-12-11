@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>Underground But Rising</h1>
        <p>Découvre et soutiens les artistes souterrains en pleine ascension.</p>
        <a class="btn-small" href="{{ route('artists.index') }}">Découvrir les artistes</a>
    </div>
</section>


<!-- ARTISTES À LA UNE -->
@if(isset($featuredArtists) && $featuredArtists->count() > 0)
<section class="section featured-artists">
    <h2 class="section-title">Artistes à la Une</h2>

    <div class="artists-grid">
        @foreach($featuredArtists as $artist)
            <div class="artist-card">
                <img src="{{ Storage::url('artists/' . $artist->photo) }}" alt="{{ $artist->name }}">

                <h3>{{ $artist->name }}</h3>

                <p>{{ $artist->genre->name ?? 'Genre non défini' }}</p>

                <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">
                    Voir le profil
                </a>
            </div>
        @endforeach
    </div>
</section>
@else
<section class="section featured-artists">
    <h2 class="section-title">Artistes à la Une</h2>
    <p class="empty-text">Aucun artiste mis en avant pour le moment.</p>
</section>
@endif

 <!-- ========================================================
         BARRE DE RECHERCHE (AJOUTÉE SOUS LA NAVBAR)
         ======================================================== -->
    <form action="{{ route('artists.search') }}" method="GET" class="search-form">
        <input 
            type="text" 
            name="q" 
            placeholder="Rechercher un artiste ou un genre..."
            class="search-input"
        >
        <button type="submit" class="search-btn">Rechercher</button>
    </form>

<!-- GENRES -->

<section class="section section-dark">
    <h2 class="section-title gold-title">Genres musicaux</h2>

    <div class="genres-grid">
        @forelse($genres as $genre)
            <a href="{{ route('genres.show', $genre->slug) }}" class="genre-card">
                @if($genre->image)
                    <img src="{{ Storage::url('genres/'.$genre->image) }}" alt="{{ $genre->name }}">
                @else
                    <div class="genre-placeholder">{{ $genre->name }}</div>
                @endif
                <span class="genre-name">{{ $genre->name }}</span>
            </a>
        @empty
            <p class="text-center">Aucun genre disponible.</p>
        @endforelse
    </div>
</section>


<!-- ACTUALITÉS -->
<section class="section">
    <h2 class="section-title">Actualités récentes</h2>

    <div class="news-grid">
        @forelse($news as $item)
            <div class="news-card">
                <img src="{{ Storage::url('news/' . $item->image) }}" alt="{{ $item->title }}">

                <h3>{{ $item->title }}</h3>
                  <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('news.index') }}" class="btn-small"> Voir toutes les actualités</a>
    </div>
               
            </div>
        @empty
            <p style="color:white;text-align:center;">Aucune actualité disponible pour le moment.</p>
        @endforelse
    </div>
</section>

@endsection
