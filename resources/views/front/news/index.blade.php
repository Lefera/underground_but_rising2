@extends('layouts.app')

@section('title', 'Actualités récentes')

@section('content')
<div class="news-container">
    <h1 class="page-title">Actualités récentes</h1>

    <div class="news-grid">
        @foreach($news as $article)
            <div class="news-card">
                @if($article->image)
                    <img src="{{ asset('storage/news/' . $article->image) }}" alt="{{ $article->title }}">
                @else
                    <img src="{{ asset('images/default-news.jpg') }}" alt="Actualité">
                @endif

                <div class="news-card-body">
                    <h2 class="news-card-title">{{ $article->title }}</h2>

                    <p class="news-card-text">
                        {{ Str::limit(strip_tags($article->content), 130) }}
                    </p>

                    <a href="{{ route('news.show', $article->slug) }}" class="btn-small">
                        Lire plus 
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $news->links() }}
    </div>
</div>
@endsection
