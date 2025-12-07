@extends('layouts.app')

@section('title', 'Révélations')

@section('content')
<section class="revelation-page">

    <h1 class="page-title">Révélations – Top 10 Rising Stars</h1>
    <p class="subtitle">
        Les artistes qui montent, repérés grâce à vos abonnements.
    </p>

    {{-- FILTRE GENRE --}}
    <form method="GET" action="{{ route('revelations') }}" class="genre-filter">
        <select name="genre" onchange="this.form.submit()">
            <option value="">Tous les genres</option>
            @foreach($genres as $g)
                <option value="{{ $g->id }}" {{ $genre == $g->id ? 'selected' : '' }}>
                    {{ $g->name }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- RISING STARS ( +100 abonnés ) --}}
    <div class="artists-grid">
        @if($artists->count() > 0)
            @foreach($artists as $artist)
                <div class="artist-card">

                    {{-- Classement (#1, #2, ...) --}}
                    <span class="rank">#{{ $loop->iteration }}</span>

                    {{-- Photo --}}
                    <img src="{{ Storage::url($artist->photo) }}" alt="{{ $artist->name }}">

                    {{-- Nom --}}
                    <h3>{{ $artist->name }}</h3>

                    {{-- Badge Rising --}}
                    @if($artist->followers_count > 100)
                        <span class="badge-rising">Rising Star</span>
                    @endif

                    {{-- Followers --}}
                    <p class="followers-count" id="followers-{{ $artist->id }}">
                        {{ $artist->followers_count }} abonnés
                    </p>

                    {{-- Bouton s'abonner --}}
                    <button class="btn-small subscribe-btn" data-id="{{ $artist->id }}">
                        S’abonner
                    </button>

                    {{-- Voir profil --}}
                    <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">
                        Voir le profil
                    </a>

                </div>
            @endforeach
        @else
            <p class="empty-text">Pas encore de stars détectées.</p>
        @endif
    </div>

    <hr class="divider">

    {{-- NOUVEAUX TALENTS --}}
    <h2 class="section-title">Nouveaux talents</h2>
    <p class="subtitle">Artistes avec 0–20 abonnés</p>

    <div class="artists-grid small-grid">
        @forelse($newTalents as $artist)
            <div class="artist-card small">
                <img src="{{ Storage::url($artist->photo) }}" alt="{{ $artist->name }}">
                <h4>{{ $artist->name }}</h4>
                <p class="followers-count">{{ $artist->followers_count }} abonnés</p>
                <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">
                    Voir le profil
                </a>
            </div>
        @empty
            <p class="empty-text">Aucun nouveau talent pour le moment.</p>
        @endforelse
    </div>

</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.subscribe-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const artistId = this.dataset.id;

            fetch(`/artists/${artistId}/follow`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                const counter = document.getElementById(`followers-${artistId}`);
                counter.textContent = data.followers + ' abonnés';

                if (data.followers > 100) {
                    let card = btn.closest('.artist-card');
                    if (!card.querySelector('.badge-rising')) {
                        let badge = document.createElement('span');
                        badge.className = 'badge-rising';
                        badge.innerText = 'Rising Star';
                        card.insertBefore(badge, counter);
                    }
                }

                btn.innerText = 'Abonné';
                btn.disabled = true;
            })
            .catch(err => console.error(err));
        });
    });
});
</script>
@endsection
