@extends('layouts.app')

@section('title', $genre->name)

@section('content')
<section class="section">
    <h1 class="section-title">{{ $genre->name }}</h1>

    @if($artists->count() > 0)
        <div class="artists-grid">
            @foreach($artists as $artist)
                <a href="{{ route('artists.show', $artist->slug) }}" class="artist-card">
                    @if($artist->photo)
                        <img src="{{ Storage::url('artists/'.$artist->photo) }}" alt="{{ $artist->name }}">
                    @endif
                    <p>{{ $artist->name }}</p>
                </a>
            @endforeach
        </div>

        <div class="pagination">
            {{ $artists->links() }}
        </div>
    @else
        <p style="color:white;text-align:center;">
            Aucun artiste disponible pour ce genre pour le moment.
        </p>
    @endif
</section>
@endsection
