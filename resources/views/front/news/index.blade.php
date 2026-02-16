@extends('layouts.app')

@section('title', 'Actualités')

@section('content')

<section class="news-page">

    <header class="news-header">
        <h1>Actualités</h1>
        <p>Les dernières nouvelles de la scène underground</p>
    </header>


    <div class="news-grid">

        @forelse ($news as $article)

            <article class="news-card">

                <a href="{{ route('news.show', $article->slug) }}" class="news-link">

                    <div class="news-image">
                        <img
                            src="{{ $article->image
                                ? asset('storage/news/' . $article->image)
                                : asset('images/default-news.jpg') }}"
                            alt="{{ $article->title }}"
                        >
                    </div>

                    <div class="news-body">

                        <span class="news-date">
                            {{ $article->created_at?->format('d M Y') }}
                        </span>

                        <h2 class="news-title">
                            {{ $article->title }}
                        </h2>

                        <p class="news-excerpt">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <span class="news-read">
                            Lire l’article →
                        </span>

                    </div>

                </a>

            </article>

        @empty
            <p class="news-empty">Aucune actualité pour le moment.</p>
        @endforelse

    </div>


    <div class="news-back">
        <a href="{{ route('home') }}" class="btn-gold">
            ← Retour à l’accueil
        </a>
    </div>

</section>

@endsection
