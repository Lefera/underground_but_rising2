@extends('layouts.app')

@section('title', 'Révélations')

@section('content')

<link rel="stylesheet" href="{{ asset('css/revelations.css') }}">

<section class="rev-page">

    <h1 class="rev-title">Révélations</h1>
    <p class="rev-sub">Artistes en pleine ascension</p>


    {{-- ========================
        FILTRE GENRES
    ========================= --}}
    <div class="genre-buttons">

        <a href="{{ route('revelations') }}"
           class="genre-btn {{ empty($genreId) ? 'active' : '' }}">
            Tous
        </a>

        @foreach($genres as $g)
            <a href="{{ route('revelations', ['genre' => $g->id]) }}"
               class="genre-btn {{ (int)$genreId === $g->id ? 'active' : '' }}">
                {{ $g->name }}
            </a>
        @endforeach

    </div>



    {{-- ========================
        TOP RÉVÉLATIONS
    ========================= --}}
    <h2 class="rev-section">Top Révélations</h2>

    <div class="artists-list">
        @forelse($artists as $artist)

            <div class="artist-line">

                <span class="rank">#{{ $loop->iteration }}</span>

                {{-- MINI PHOTO --}}
                <img
                    class="artist-avatar"
                    src="{{ $artist->photo ? Storage::url('artists/'.$artist->photo) : asset('images/avatar.png') }}"
                    alt="{{ $artist->name }}"
                >

                <span class="name">{{ $artist->name }}</span>

                @if($artist->badge_label)
                    <span class="{{ $artist->badge_class }}">
                        {{ $artist->badge_label }}
                    </span>
                @endif

                <span class="followers">
                    {{ $artist->followers_count }} abonnés
                </span>

                <a href="{{ route('artists.show', $artist->slug) }}" class="view-link">
                    Voir
                </a>
            </div>

        @empty
            <p class="empty-text">Aucune révélation pour le moment.</p>
        @endforelse
    </div>



    {{-- ========================
        NOUVEAUX TALENTS
    ========================= --}}
    <h2 class="rev-section">Nouveaux talents</h2>

    <div class="artists-list">
        @forelse($newTalents as $artist)

            <div class="artist-line small">

                <img
                    class="artist-avatar small-avatar"
                    src="{{ $artist->photo ? Storage::url('artists/'.$artist->photo) : asset('images/avatar.png') }}"
                    alt="{{ $artist->name }}"
                >

                <span class="name">{{ $artist->name }}</span>

                @if($artist->badge_label)
                    <span class="{{ $artist->badge_class }}">
                        {{ $artist->badge_label }}
                    </span>
                @endif

                <span class="followers">
                    {{ $artist->followers_count }} abonnés
                </span>

                <a href="{{ route('artists.show', $artist->slug) }}" class="view-link">
                    Voir
                </a>
            </div>

        @empty
            <p class="empty-text">Aucun nouveau talent pour le moment.</p>
        @endforelse
    </div>

</section>
@endsection
