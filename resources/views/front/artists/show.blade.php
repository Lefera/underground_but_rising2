@extends('layouts.app')

@section('title', $artist->name)

@section('content')
<div class="artist-profile-container">

    {{-- HEADER AVEC PHOTO --}}
    <div class="artist-header">
        @if($artist->photo)
            <img class="artist-photo" src="{{ Storage::url('artists/' .$artist->photo) }}" alt="{{ $artist->name }}">
        @endif

        <div class="artist-info">
            <h1 class="artist-name">
                {{ $artist->name }}

                {{-- Badge Rising Star --}}
               @if($artist->is_rising_star)
                    <span class="badge-rising">Rising Star</span>
                @endif
            </h1>

            {{-- Compteur abonnés --}}
            <p class="followers-count">
                {{ $artist->followers()->count() }} abonnés
            </p>

            <p class="artist-genre">{{ $artist->genre->name ?? 'Genre non défini' }}</p>

            {{-- S’ABONNER --}}
            <div class="subscribe-box">
                @auth
                    @if(auth()->user()->followedArtists->contains($artist->id))
                        <form action="{{ route('artists.unfollow', $artist->id) }}" method="POST">
                            @csrf
                            <button class="btn-unfollow">Se désabonner</button>
                        </form>
                    @else
                        <form action="{{ route('artists.follow', $artist->id) }}" method="POST">
                            @csrf
                            <button class="btn-follow">S’abonner</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-follow">Se connecter pour s’abonner</a>
                @endauth
            </div>
        </div>
    </div>


    {{-- BIOGRAPHIE --}}
    <div class="artist-section">
        <h2>Biographie</h2>
        <p>{!! $artist->bio ? nl2br(e($artist->bio)) : 'Aucune description pour cet artiste.' !!}</p>
    </div>


    {{-- RÉSEAUX SOCIAUX --}}
    <div class="artist-section">
        <h2>Réseaux sociaux</h2>
        <div class="social-links">
            @if($artist->facebook)
                <a href="{{ $artist->facebook }}" target="_blank">Facebook</a>
            @endif

            @if($artist->instagram)
                <a href="{{ $artist->instagram }}" target="_blank">Instagram</a>
            @endif

             @if($artist->youtube_link)
                <a href="{{ $artist->youtube_link }}" target="_blank">youtube</a>
            @endif
        </div>
    </div>


    {{-- MUSIQUES --}}
    <div class="artist-section">
        <h2>Musiques</h2>

        @if($artist->tracks->whereNotNull('audio')->count() > 0)
            <div class="media-grid">
                @foreach($artist->tracks as $track)
                    @if($track->audio)
                    <div class="media-card">
                        <p class="media-title">{{ $track->title }}</p>
                        <audio controls>
                            <source src="{{ Storage::url($track->audio) }}" type="audio/mp3">
                        </audio>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <p>Aucune musique disponible.</p>
        @endif
    </div>


    {{-- VIDEOS --}}
    <div class="artist-section">
        <h2>Vidéos</h2>

        @if($artist->tracks->whereNotNull('youtube_link')->count() > 0)
            <div class="media-grid">
                @foreach($artist->tracks as $track)
                    @if($track->youtube_link)
                    <div class="media-card">
                        <iframe class="video-frame"
                            src="{{ str_replace('watch?v=', 'embed/', $track->youtube_link) }}"
                            allowfullscreen></iframe>
                        <p class="media-title">{{ $track->title }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <p>Aucune vidéo disponible.</p>
        @endif
    </div>

</div>
@endsection
