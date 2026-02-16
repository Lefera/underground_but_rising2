@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="admin-dashboard">

    {{-- =========================
        HEADER
    ========================== --}}
    <h1 class="admin-title">Dashboard Administrateur</h1>
    <p class="admin-subtitle">
        Vue d’ensemble de la plateforme Underground But Rising
    </p>



    {{-- =========================
        STATISTIQUES
    ========================== --}}
    <div class="stats-grid">

        <div class="stat-card">
            <h3>Total artistes</h3>
            <p>{{ $artistsCount }}</p>
        </div>

        <div class="stat-card">
            <h3>Œuvres publiées</h3>
            <p>{{ $tracksCount }}</p>
        </div>

        <div class="stat-card">
            <h3>Messages reçus</h3>
            <p>{{ $messagesCount }}</p>
        </div>

        <div class="stat-card">
            <h3>Actualités</h3>
            <p>{{ $newsCount }}</p>
        </div>

    </div>



    {{-- =========================
        PANELS ACTIVITÉS
    ========================== --}}
    <div class="panels-grid">

        {{-- =========================
            DERNIERS ARTISTES
        ========================== --}}
        <div class="panel">
            <h3>Derniers artistes ajoutés</h3>

            <ul>
                @forelse($latestArtists as $artist)
                    <li class="artist-row">

                        <div>
                            <strong>{{ $artist->name }}</strong>
                            <small>• {{ $artist->city ?? '—' }}</small>
                        </div>

                        <div class="artist-actions">
                            {{-- Voir profil --}}
                            <a href="{{ route('artists.show', $artist) }}" class="mini-btn">
                                👁 Voir
                            </a>

                            {{-- Ajouter œuvre (FIX 404 ICI) --}}
                            <a href="{{ route('tracks.create', $artist) }}" class="mini-btn success">
                                🎵 Ajouter œuvre
                            </a>
                        </div>

                    </li>
                @empty
                    <li>Aucun artiste pour le moment</li>
                @endforelse
            </ul>
        </div>



        {{-- =========================
            DERNIÈRES ŒUVRES
        ========================== --}}
        <div class="panel">
            <h3>Dernières œuvres publiées</h3>

            <ul>
                @forelse($latestTracks as $track)
                    <li>
                        {{ $track->title }}
                        <small>• {{ $track->artist->name }}</small>
                    </li>
                @empty
                    <li>Aucune œuvre publiée</li>
                @endforelse
            </ul>
        </div>



        {{-- =========================
            MESSAGES RÉCENTS
        ========================== --}}
        <div class="panel">
            <h3>Messages récents</h3>

            <ul>
                @forelse($latestMessages as $message)
                    <li>
                        {{ $message->sender->name ?? 'Utilisateur' }} :
                        {{ \Illuminate\Support\Str::limit($message->content, 40) }}
                    </li>
                @empty
                    <li>Aucun message</li>
                @endforelse
            </ul>
        </div>



        {{-- =========================
            ACTUALITÉS
        ========================== --}}
        <div class="panel">
            <h3>Actualités récentes</h3>

            <ul>
                @forelse($latestNews as $article)
                    <li>{{ $article->title }}</li>
                @empty
                    <li>Aucune actualité</li>
                @endforelse
            </ul>
        </div>

    </div>



    {{-- =========================
        ACTIONS RAPIDES
    ========================== --}}
    <div class="admin-actions">

        <a href="{{ route('artists.create') }}" class="admin-btn">
            ➕ Ajouter un artiste
        </a>

        <a href="{{ route('admin.messages.index') }}" class="admin-btn">
            📩 Gérer messages
        </a>

        <a href="{{ route('news.index') }}" class="admin-btn">
            📰 Voir actualités
        </a>

    </div>

</div>

@endsection
