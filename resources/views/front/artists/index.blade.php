@extends('layouts.app')

@section('title', 'Artistes')

@section('content')



<section class="artists-page">

    <header class="artists-header">
        <h1 class="artists-title">Artistes</h1>
        <p class="artists-sub">
            Découvrez les talents présents sur Underground But Rising
        </p>
    </header>


    <div class="artists-grid">

        @forelse($artists as $artist)

            <div class="artist-card">

                {{-- PHOTO --}}
                <img
                    class="artist-img"
                    src="{{ $artist->photo
                        ? Storage::url('artists/'.$artist->photo)
                        : asset('images/avatar.png') }}"
                    alt="{{ $artist->name }}"
                >

                {{-- INFOS --}}
                <div class="artist-info">

                    <strong class="artist-name">
                        {{ $artist->name }}
                    </strong>

                    <small class="artist-genre">
                        {{ $artist->genre->name ?? '—' }}
                    </small>

                    <span class="artist-followers">
                        {{ $artist->followers_count }} abonnés
                    </span>

                    {{-- BOUTON VOIR PROFIL --}}
                    <a href="{{ route('artists.show', $artist) }}"
                       class="btn-view">
                        👁 Voir le profil
                    </a>

                </div>

            </div>

        @empty
            <p class="artists-empty">Aucun artiste pour le moment.</p>
        @endforelse

    </div>


    {{-- BOUTON RETOUR ACCUEIL --}}
    <div class="artists-back">
        <a href="{{ route('home') }}" class="btn-back">
            ← Retour à l’accueil
        </a>
    </div>

</section>

@endsection
