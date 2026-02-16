@extends('layouts.app')

@section('title', $artist->name)

@section('content')

<section class="artist-profile">

    {{-- ================= BANNIÈRE ================= --}}
    <div class="artist-banner"
         style="background-image:url('{{ $artist->banner_url }}')">

        <div class="banner-overlay"></div>
    </div>


    {{-- ================= HEADER ================= --}}
    <div class="artist-header">

        <img class="artist-avatar"
             src="{{ $artist->photo_url }}"
             alt="{{ $artist->name }}">

        <div class="artist-meta">

            <h1>{{ $artist->name }}</h1>

            <div class="artist-stats">
                <span class="badge">{{ $artist->followers()->count() }} abonnés</span>
                <span class="badge">{{ number_format($artist->views) }} vues</span>
                <span class="badge">{{ $artist->genre->name ?? '—' }}</span>
            </div>

            @auth
                @if(auth()->user()->followedArtists->contains($artist->id))
                    <form action="{{ route('artists.unfollow',$artist->slug) }}" method="POST">
                        @csrf
                        <button class="btn-gold-outline">Se désabonner</button>
                    </form>
                @else
                    <form action="{{ route('artists.follow',$artist->slug) }}" method="POST">
                        @csrf
                        <button class="btn-gold">S’abonner</button>
                    </form>
                @endif
            @endauth

        </div>
    </div>


    {{-- ================= BIO ================= --}}
    <div class="artist-section">
        <h2>Biographie</h2>
        <p>{!! nl2br(e($artist->bio ?? 'Aucune description.')) !!}</p>
    </div>

    {{-- ================= SOCIAL (LIKE + COMMENTAIRES) ================= --}}
<div class="artist-section">

    <h2>Communauté</h2>

    {{-- ===== LIKE ===== --}}
    @auth
    <form action="{{ route('like.toggle',['artist',$artist->id]) }}" method="POST">
        @csrf
        <button class="btn-gold">
            👍 {{ $artist->likes()->count() }} J’aime
        </button>
    </form>
    @endauth


    {{-- ===== AJOUT COMMENTAIRE ===== --}}
    @auth
    <form action="{{ route('comment.store',['artist',$artist->id]) }}" method="POST" style="margin-top:20px;">
        @csrf
        <textarea name="content" required placeholder="Écrire un commentaire..." style="width:100%;padding:10px;border-radius:8px;"></textarea>
        <button class="btn-gold" style="margin-top:10px;">Envoyer</button>
    </form>
    @else
        <p>Connectez-vous pour commenter.</p>
    @endauth


    {{-- ===== LISTE COMMENTAIRES ===== --}}
    <div style="margin-top:40px">

        @foreach($artist->comments as $comment)

            <div class="comment-box">

                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->content }}</p>


                {{-- ===== REPONSE ===== --}}
                @auth
                <form action="{{ route('comment.store',['artist',$artist->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <input name="content" placeholder="Répondre..." style="width:100%;padding:6px;border-radius:6px;">
                </form>
                @endauth


                {{-- ===== REPONSES ===== --}}
                @foreach($comment->replies as $reply)
                    <div class="reply-box">
                        <strong>{{ $reply->user->name }}</strong>
                        {{ $reply->content }}
                    </div>
                @endforeach

            </div>

        @endforeach

    </div>

</div>


    {{-- ================= AUDIOS ================= --}}
    @if($artist->tracks->whereNotNull('audio_file')->count())
    <div class="artist-section">
        <h2>Audios</h2>

        <div class="media-grid">
            @foreach($artist->tracks as $track)
                @if($track->audio_file)
                <div class="media-card">
                    <audio controls>
                        <source src="{{ Storage::url($track->audio_file) }}">
                    </audio>
                    <p>{{ $track->title }}</p>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif


    {{-- ================= VIDEOS ================= --}}
    @if($artist->tracks->whereNotNull('youtube_link')->count())
    <div class="artist-section">
        <h2>Vidéos</h2>

        <div class="media-grid">
            @foreach($artist->tracks as $track)
                @if($track->youtube_link)
                <div class="media-card">
                    <iframe
                        src="{{ str_replace('watch?v=','embed/',$track->youtube_link) }}"
                        allowfullscreen>
                    </iframe>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif


    <div class="back-center">
        <a href="{{ route('artists.index') }}" class="btn-gold-outline">
            ← Retour
        </a>
    </div>

</section>

@endsection
