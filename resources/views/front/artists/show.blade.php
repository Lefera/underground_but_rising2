@extends('layouts.app')

@section('title', $artist->name)

@section('content')
<div class="artist-profile-container">

    {{-- HEADER AVEC PHOTO --}}
    <div class="artist-header">
        @if($artist->photo)
            <img class="artist-photo" src="{{ Storage::url('artists/' .$artist->photo) }}" alt="{{ $artist->name }}">
        @endif

        <div class="artist-info">
            <h1 class="artist-name">
                {{ $artist->name }}

                {{-- Badge Rising Star --}}
                @if($artist->is_rising_star)
                    <span class="badge-rising">Rising Star</span>
                @endif
            </h1>

            {{-- Compteur abonnés --}}
            <p class="followers-count">
                {{ $artist->followers()->count() }} abonnés
            </p>

            <p class="artist-genre">{{ $artist->genre->name ?? 'Genre non défini' }}</p>

            {{-- S’ABONNER --}}
            <div class="subscribe-box">
                @auth
                   @if(auth()->user()->followedArtists->contains('id', $artist->id))
                        <form action="{{ route('artists.unfollow', $artist->slug) }}" method="POST">
                            @csrf
                            <button class="btn-unfollow">Se désabonner</button>
                        </form>
                    @else
                        <form action="{{ route('artists.follow', $artist->slug) }}" method="POST">
                            @csrf
                            <button class="btn-follow">S’abonner</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-follow">Se connecter pour s’abonner</a>
                @endauth

                                    {{-- BOUTON CONTACTER L'ARTISTE --}}
                    <a href="{{ route('artists.contact.form', $artist->id) }}" class="btn-message">
                        Contacter l’artiste
                    </a>

            </div>
        </div>
    </div>


    {{-- BIOGRAPHIE --}}
    <div class="artist-section">
        <h2>Biographie</h2>
        <p>{!! $artist->bio ? nl2br(e($artist->bio)) : 'Aucune description pour cet artiste.' !!}</p>
    </div>


    {{-- RÉSEAUX SOCIAUX --}}
    <div class="artist-section">
        <h2>Réseaux sociaux</h2>
        <div class="social-links">

            @if($artist->facebook)
                <a href="{{ $artist->facebook }}" target="_blank" class="social-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22 12.07C22 6.63 17.52 2.15 12.08 2.15C6.64 2.15 2.16 6.63 2.16 12.07C2.16 17.09 5.93 21.25 10.66 22V14.89H8.08V12.07H10.66V9.96C10.66 7.41 12.18 6.04 14.47 6.04C15.57 6.04 16.72 6.23 16.72 6.23V8.73H15.45C14.2 8.73 13.5 9.52 13.5 10.29V12.07H16.6L16.1 14.89H13.5V22C18.23 21.25 22 17.09 22 12.07Z"/>
                    </svg>
                    Facebook
                </a>
            @endif

            @if($artist->instagram)
                <a href="{{ $artist->instagram }}" target="_blank" class="social-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 2C4.24 2 2 4.24 2 7V17C2 19.76 4.24 22 7 22H17C19.76 22 22 19.76 22 17V7C22 4.24 19.76 2 17 2H7ZM12 17.5C9.24 17.5 7 15.26 7 12.5C7 9.74 9.24 7.5 12 7.5C14.76 7.5 17 9.74 17 12.5C17 15.26 14.76 17.5 12 17.5ZM18 6.5C18 7.33 17.33 8 16.5 8C15.67 8 15 7.33 15 6.5C15 5.67 15.67 5 16.5 5C17.33 5 18 5.67 18 6.5Z"/>
                    </svg>
                    Instagram
                </a>
            @endif

            @if($artist->youtube_link)
                <a href="{{ $artist->youtube_link }}" target="_blank" class="social-link">
                    <svg width="22" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21.8 8.001C21.6 7.001 20.9 6.3 20 6.101C18.3 5.7 12 5.7 12 5.7C12 5.7 5.7 5.7 4 6.101C3.1 6.3 2.4 7.001 2.2 8.001C1.8 9.701 1.8 12.001 1.8 12.001C1.8 12.001 1.8 14.301 2.2 16.001C2.4 17.001 3.1 17.701 4 17.901C5.7 18.301 12 18.301 12 18.301C12 18.301 18.3 18.301 20 17.901C20.9 17.701 21.6 17.001 21.8 16.001C22.2 14.301 22.2 12.001 22.2 12.001C22.2 12.001 22.2 9.701 21.8 8.001ZM10.7 15.001V9.001L15 12.001L10.7 15.001Z"/>
                    </svg>
                    YouTube
                </a>
            @endif

        </div>
    </div>



{{-- AUDIOS --}}
<div class="artist-section">
    <h2>Audios</h2>

    @if($artist->tracks->whereNotNull('audio_file')->count() > 0)
        <div class="media-grid">
            @foreach($artist->tracks as $track)
                @if($track->audio_file)
                <div class="media-card">
                    <audio controls>
                        <source src="{{ Storage::url($track->audio_file) }}" type="audio/mpeg">
                    </audio>

                    <p class="media-title">{{ $track->title }}</p>

                    {{-- =======================
                        BOUTON PARTAGER AUDIO
                    ======================== --}}
                    <button class="btn-share" 
                            onclick="shareTrack('{{ $track->title }}', '{{ url()->current() }}')">
                        Partager ce titre
                    </button>

                </div>
                @endif
            @endforeach
        </div>
    @else
        <p>Aucun audio disponible.</p>
    @endif
</div>




    {{-- VIDEOS --}}
    <div class="artist-section">
        <h2>Vidéos</h2>

        @if($artist->tracks->whereNotNull('youtube_link')->count() > 0)
            <div class="media-grid">
                @foreach($artist->tracks as $track)
                    @if($track->youtube_link)
                    <div class="media-card">
                        <iframe class="video-frame"
                            src="{{ str_replace('watch?v=', 'embed/', $track->youtube_link) }}"
                            allowfullscreen></iframe>

                        <p class="media-title">{{ $track->title }}</p>

                        {{-- =======================
                            BOUTON PARTAGER VIDEO
                        ======================== --}}
                        <button class="btn-share" 
                                onclick="shareTrack('{{ $track->title }}', '{{ url()->current() }}')">
                            Partager cette vidéo
                        </button>

                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <p>Aucune vidéo disponible.</p>
        @endif
    </div>



    <!-- ============================================
     BOUTONS DE PARTAGE DE LA PAGE ARTISTE
     ============================================ -->
<div class="share-container">

    @php
        $shareUrl = urlencode( request()->fullUrl() );
    @endphp

    <a href="https://wa.me/?text={{ $shareUrl }}" 
       target="_blank" class="share-btn whatsapp">
        Partager sur WhatsApp
    </a>

    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" 
       target="_blank" class="share-btn facebook">
        Partager sur Facebook
    </a>

    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}" 
       target="_blank" class="share-btn twitter">
        Partager sur X
    </a>

</div>


{{-- BOUTON POUR MODIFIER LA PHOTO --}}
<form action="{{ route('artists.updatePhoto', $artist->id) }}" 
      method="POST" enctype="multipart/form-data" style="margin-top:10px;">
    @csrf
    <input id="upload-photo" type="file" name="photo" style="display: none;" 
           onchange="this.form.submit()">
    <button type="button" 
            onclick="document.getElementById('upload-photo').click()"
            class="btn-edit-photo">
        Modifier la photo de profil
    </button>
</form><br>


{{-- BOUTON PARTAGER ARTISTE --}}
<button class="btn-share" onclick="shareArtist()">
    Partager l’artiste
</button>

<script>
function shareArtist() {
    const url = "{{ url()->current() }}";
    if (navigator.share) {
        navigator.share({
            title: "{{ $artist->name }}",
            text: "Découvre cet artiste underground :",
            url: url
        });
    } else {
        navigator.clipboard.writeText(url);
        alert('Lien copié !');
    }
}

// PARTAGER UN TRACK (audio ou vidéo)
function shareTrack(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: "Découvre ce titre underground : " + title,
            url: url
        });
    } else {
        navigator.clipboard.writeText(url);
        alert('Lien du titre copié.');
    }
}
</script>

</div>
@endsection
