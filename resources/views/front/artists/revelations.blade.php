@extends('layouts.app')

@section('title', 'Révélations')

@section('content')
<section class="revelation-page">

    <h1 class="page-title">Révélations – Top 10 Rising Stars</h1>

    <p class="subtitle">
        Les artistes qui montent, repérés grâce à vos abonnements.
    </p>

    <div class="artists-grid">
        @forelse($artists as $artist)
            <div class="artist-card">
                
                {{-- Photo --}}
                <img src="{{ Storage::url($artist->photo) }}" alt="{{ $artist->name }}">

                {{-- Nom --}}
                <h3>{{ $artist->name }}</h3>

                {{-- Badge Rising (seulement si +100 abonnés) --}}
                @if($artist->followers()->count() > 100)
                    <span class="badge-rising">Rising Star</span>
                @endif

                {{-- Compteur abonnés --}}
                <p class="followers-count" id="followers-{{ $artist->id }}">
                    {{ $artist->followers()->count() }} abonnés
                </p>

                {{-- Bouton s'abonner --}}
                <button class="btn-small subscribe-btn"
                    data-id="{{ $artist->id }}">
                    S’abonner
                </button>

                {{-- Voir profil --}}
                <a href="{{ route('artists.show', $artist->slug) }}" class="btn-small">
                    Voir le profil
                </a>

            </div>
        @empty
            <p class="empty-text">Pas encore de stars détectées.</p>
        @endforelse
    </div>

</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.subscribe-btn');

        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                const artistId = this.getAttribute('data-id');

                fetch(`/artists/${artistId}/follow`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Mise à jour du compteur
                    const countEl = document.getElementById(`followers-${artistId}`);
                    countEl.textContent = data.followers + " abonnés";

                    // Si >100 abonnes → afficher badge Rising
                    if (data.followers > 100) {
                        let card = btn.closest('.artist-card');
                        if (!card.querySelector('.badge-rising')) {
                            let badge = document.createElement('span');
                            badge.classList.add('badge-rising');
                            badge.textContent = 'Rising Star';
                            card.insertBefore(badge, countEl);
                        }
                    }

                    // Désactiver le bouton après abonnement
                    btn.textContent = "Abonné";
                    btn.disabled = true;
                })
                .catch(err => console.error(err));
            });
        });
    });
</script>
@endsection
