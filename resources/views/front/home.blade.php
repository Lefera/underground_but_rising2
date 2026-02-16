@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- ==============================
     HERO – HOME
================================ -->

<section class="hero-slider">

    <div class="hero-slides">
       <img src="{{ asset('storage/artists/Tazo2.jpg') }}" class="hero-slide active">
        <img src="{{ asset('storage/artists/BoyRe.jpeg') }}" class="hero-slide">
        <img src="{{ asset('storage/artists/lokesha3.jpg') }}" class="hero-slide">
        <img src="{{ asset('storage/artists/baggioperf.jpg') }}" class="hero-slide">
    </div>

    <div class="hero-overlay">
        <div class="hero-content">
            <h1>SOUTERRAIN MAIS EN HAUSSE</h1>
            <p>Découvre et soutiens les artistes underground en pleine ascension.</p>
            <a href="{{ route('artists.index') }}" class="btn-gold">Découvrir les artistes</a>
        </div>
    </div>

    <!-- FLÈCHES -->
    <button class="hero-arrow prev">&#10094;</button>
    <button class="hero-arrow next">&#10095;</button>

</section>



<!-- ARTISTES À LA UNE -->
@if(isset($featuredArtists) && $featuredArtists->count())
<section class="home-featured">

    <div class="home-featured-header">
        <h2>Artistes à la Une</h2>
        <p>Talents underground en pleine ascension</p>
    </div>

    <div class="home-featured-grid">

        @foreach($featuredArtists as $artist)
            <a href="{{ route('artists.show', $artist->slug) }}" class="home-featured-card">

                <div class="home-featured-image">
                    <img 
                        src="{{ Storage::url('artists/' . $artist->photo) }}" 
                        alt="{{ $artist->name }}"
                    >
                </div>

                <div class="home-featured-info">
                    <strong class="artist-name">{{ $artist->name }}</strong>

                    <span class="artist-genre">
                        {{ $artist->genre->name ?? 'Genre non défini' }}
                    </span>

                    <span class="artist-cta">
                        Voir le profil →
                    </span>
                </div>

            </a>
        @endforeach

    </div>

</section>
@else
<section class="home-featured">
    <div class="home-featured-header">
        <h2>Artistes à la Une</h2>
        <p>Aucun artiste mis en avant pour le moment</p>
    </div>
</section>
@endif

 <!-- ==============================
     RECHERCHE ARTISTES – UBR
================================ -->
<section class="home-search">
    <div class="home-search-inner">
        <h2 class="home-search-title">
            Explorer la scène underground
        </h2>

        <p class="home-search-sub">
            Trouve un artiste ou un genre en pleine ascension
        </p>

        <form action="{{ route('artists.index') }}" method="GET" class="home-search-form">
    <input
        type="text"
        name="q"
        class="home-search-input"
        placeholder="Nom d’artiste, genre musical…"
        autocomplete="off"
    >

    <button type="submit" class="home-search-btn">
        Rechercher
    </button>
</form>

    </div>
</section>

<!-- ==============================
     GENRES – UBR STYLE
================================ -->
<section class="home-genres">
    <div class="home-genres-inner">

        <h2 class="home-genres-title">
            Genres musicaux
        </h2>

        <p class="home-genres-sub">
            Explore les univers sonores de la scène underground
        </p>

        <div class="home-genres-grid">
            @forelse($genres as $genre)

                <a href="{{ route('genres.show', $genre->slug) }}" class="home-genre-card">

                    @if($genre->image)
                        <img
                            src="{{ Storage::url('genres/'.$genre->image) }}"
                            alt="{{ $genre->name }}"
                            class="home-genre-img"
                        >
                    @else
                        <div class="home-genre-placeholder">
                            {{ strtoupper(substr($genre->name, 0, 1)) }}
                        </div>
                    @endif

                    <span class="home-genre-name">
                        {{ $genre->name }}
                    </span>

                </a>

            @empty
                <p class="home-genres-empty">
                    Aucun genre disponible.
                </p>
            @endforelse
        </div>

    </div>
</section>



<!-- ACTUALITÉS STYLE MAGAZINE -->
<section class="home-news">

    <div class="home-news-header">
        <h2>Actualités</h2>

        <a href="{{ route('news.index') }}" class="home-news-link">
            Toutes les actualités →
        </a>
    </div>


    @if($news->count())

        <div class="home-news-layout">

            {{-- ARTICLE PRINCIPAL --}}
            @php $main = $news->first(); @endphp

            <a href="{{ route('news.show', $main->slug) }}" class="home-news-main">

                <img src="{{ Storage::url('news/'.$main->image) }}" alt="{{ $main->title }}">

                <div class="home-news-main-content">
                    <h3>{{ $main->title }}</h3>
                </div>

            </a>


            {{-- PETITES ACTUS --}}
            <div class="home-news-side">

                @foreach($news->skip(1)->take(3) as $item)

                    <a href="{{ route('news.show', $item->slug) }}" class="home-news-item">

                        <img src="{{ Storage::url('news/'.$item->image) }}" alt="{{ $item->title }}">

                        <span>{{ $item->title }}</span>

                    </a>

                @endforeach

            </div>

        </div>

    @else

        <p class="home-news-empty">Aucune actualité disponible.</p>

    @endif


   <script>
document.addEventListener("DOMContentLoaded", function(){

    const slides = document.querySelectorAll(".hero-slide");
    const nextBtn = document.querySelector(".hero-arrow.next");
    const prevBtn = document.querySelector(".hero-arrow.prev");

    let index = 0;
    let interval;

    function showSlide(i){
        slides.forEach(slide => slide.classList.remove("active"));
        slides[i].classList.add("active");
    }

    function nextSlide(){
        index = (index + 1) % slides.length;
        showSlide(index);
    }

    function prevSlide(){
        index = (index - 1 + slides.length) % slides.length;
        showSlide(index);
    }

    function startAuto(){
        interval = setInterval(nextSlide, 4000);
    }

    function resetAuto(){
        clearInterval(interval);
        startAuto();
    }

    nextBtn.addEventListener("click", () => {
        nextSlide();
        resetAuto();
    });

    prevBtn.addEventListener("click", () => {
        prevSlide();
        resetAuto();
    });

    startAuto();

});
</script>



</section>


@endsection
