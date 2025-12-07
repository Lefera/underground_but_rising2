@extends('layouts.app')

@section('title', 'Liste des Artistes')

@section('content')

<section class="artists-list-page">

    <h1 class="page-title">Tous les artistes</h1>

    <div class="artists-grid">

        @forelse($artists as $artist)
            <div class="artist-card">

                {{-- PHOTO --}}
                <img src="{{ Storage::url('artists/'.$artist->photo) }}" alt="{{ $artist->name }}">

                {{-- NOM --}}
                <h3>{{ $artist->name }}</h3>

                {{-- BADGE Rising Star si +100 abonnés --}}
                @if($artist->followers()->count() >= 100)
                    <span class="badge-rising">Rising Star</span>
                @endif

                {{-- Compteur d'abonnés --}}
                <p class="followers-count">
                    {{ $artist->followers()->count() }} abonnés
                </p>

                {{-- GENRE --}}
                <p>{{ $artist->genre->name ?? 'Genre non défini' }}</p>

                {{-- ABONNEMENT --}}
                @auth
                    @php
                        $isFollowing = auth()->user()->followedArtists->contains($artist->id);
                    @endphp

                    @if(!$isFollowing)
                        <form action="{{ route('artists.follow', $artist) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-subscribe">S’abonner</button>
                        </form>
                    @else
                        <form action="{{ route('artists.unfollow', $artist) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-unsubscribe">Se désabonner</button>
                        </form>
                    @endif
                @endauth

                {{-- BOUTON PROFIL --}}
                <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">
                    Voir le profil
                </a>

            </div>
        @empty
            <p class="empty-text">Aucun artiste disponible pour le moment.</p>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="pagination-container">
        {{ $artists->links() }}
    </div>

</section>

@endsection
