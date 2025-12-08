@extends('layouts.app')

@section('title', $news->title)

@section('content')

<section class="news-details">

    {{-- Image principale --}}
    @if($news->image)
        <div class="news-cover">
            <img src="{{ Storage::url('news/'.$news->image) }}" alt="{{ $news->title }}">
        </div>
    @endif

    <div class="news-content">
        <h1 class="news-title">{{ $news->title }}</h1>

        <p class="news-date">
           {{ $news->created_at ? $news->created_at->format('d/m/Y') : '' }}
        </p>

        <div class="news-text">
            {!! nl2br(e($news->content)) !!}
        </div>
    </div>

</section>


{{-- Artistes liés à l’actualité --}}
@if($news->artists && $news->artists->count() > 0)
<section class="news-artists">
    <h2 class="section-title">Artistes Mentionnés</h2>

    <div class="artists-grid">
        @foreach($news->artists as $artist)
            <div class="artist-card">
                <img src="{{ Storage::url('artists/' . $artist->photo) }}" alt="{{ $artist->name }}">
                <h3>{{ $artist->name }}</h3>
                <p>{{ $artist->genre->name ?? 'Genre inconnu' }}</p>
                <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">Voir le profil</a>
            </div>
        @endforeach
    </div>
</section>
@endif


{{-- Images supplémentaires (table pivot : NewsImage) --}}
@if($news->images && $news->images->count() > 0)
<section class="news-images">
    <h2 class="section-title">Galerie</h2>

    <div class="gallery-grid">
        @foreach($news->images as $image)
            <div class="gallery-item">
                <img src="{{ Storage::url('news/' . $image->file_name) }}" alt="image-actu">
            </div>
        @endforeach
    </div>
</section>
@endif


{{-- Bouton retour --}}
<div class="btn-small-container">
    <a href="{{ route('news.index') }}" class="btn-small-back">Retour aux actualités</a>
</div>

@endsection
