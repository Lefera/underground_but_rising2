@extends('layouts.app')

@section('content')

<div class="search-page">

    <h1 class="search-title">Résultats pour : "{{ $query }}"</h1>

    @if($artists->count() == 0)
        <p class="no-result">Aucun artiste trouvé pour ce terme.</p>
    @endif

    <div class="artist-grid">
        @foreach($artists as $artist)
            <div class="artist-card">
                <a href="{{ route('artists.show', $artist->slug) }}">
                    <img src="{{ Storage::url('artists/' . $artist->photo) }}" alt="{{ $artist->name }}">
                </a>
                <h3>{{ $artist->name }}</h3>
                <p>{{ $artist->genre->name ?? 'Genre inconnu' }}</p>
            </div>
        @endforeach
    </div>

    {{ $artists->links() }}

</div>

@endsection
