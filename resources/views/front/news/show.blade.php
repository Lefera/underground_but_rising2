@extends('layouts.app')

@section('title', $news->title)

@section('content')

<section class="news-details">

    <div class="news-header">
        <h1 class="news-title">{{ $news->title }}</h1>
        <p class="news-date">Publié le {{ $news->created_at->format('d/m/Y') }}</p>
    </div>

    @if($news->photo)
    <img src="{{ Storage::url('news/' . $news->image) }}" 
         alt="{{ $news->title }}" class="news-main-image">
    @endif

    <div class="news-content">
        {!! nl2br(e($news->content)) !!}
    </div>

    <div class="news-actions">
        <a href="{{ route('news.index') }}" class="btn-back">Retour aux actualités</a>
    </div>

</section>

@endsection
