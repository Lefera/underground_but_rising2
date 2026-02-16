

@extends('layouts.app')

@section('title', $news->title)

@section('content')

<article class="news-article">

    {{-- HERO COVER --}}
    @if($news->image)
        <div class="news-hero">
            <img src="{{ Storage::url('news/'.$news->image) }}" alt="{{ $news->title }}">
            <div class="news-hero-overlay">
                <h1>{{ $news->title }}</h1>
                <span>{{ $news->created_at?->format('d F Y') }}</span>
            </div>
        </div>
    @endif


    {{-- CONTENU --}}
    <div class="news-content">

        <div class="news-text">
            {!! nl2br(e($news->content)) !!}
        </div>

    </div>

</article>



{{-- ARTISTES LIÉS --}}
@if($news->artists && $news->artists->count() > 0)
<section class="news-related">

    <h2 class="section-title">Artistes mentionnés</h2>

    <div class="artists-grid">
        @foreach($news->artists as $artist)

            <a href="{{ route('artists.show', $artist->slug) }}" class="artist-card">

                <img src="{{ Storage::url('artists/' . $artist->photo) }}" alt="{{ $artist->name }}">

                <div class="artist-info">
                    <strong>{{ $artist->name }}</strong>
                    <small>{{ $artist->genre->name ?? '—' }}</small>
                </div>

            </a>

        @endforeach
    </div>

</section>
@endif



{{-- GALERIE --}}
@if($news->images && $news->images->count() > 0)
<section class="news-gallery">

    <h2 class="section-title">Galerie</h2>

    <div class="gallery-grid">
        @foreach($news->images as $image)
            <img src="{{ Storage::url('news/' . $image->file_name) }}" alt="">
        @endforeach
    </div>

</section>
@endif



<div class="news-back">
    <a href="{{ route('news.index') }}" class="btn-gold">
        ← Retour aux actualités
    </a>
</div>

@endsection
