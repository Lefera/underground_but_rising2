@extends('layouts.app')

@section('title', 'Réinitialisation du mot de passe')

@section('content')

<section class="auth-full"
    style="background-image: url('{{ asset('storage/artists/Tazo2.jpg') }}');">

    {{-- COLONNE GAUCHE --}}
    <div class="auth-visual">
        <div class="auth-visual-content">
            <h1>Underground<br>But Rising</h1>
            <p>Réinitialise ton accès et continue l’aventure.</p>

            <a href="{{ route('home') }}" class="visual-home">
                ← Retour à l’accueil
            </a>
        </div>
    </div>

    {{-- COLONNE DROITE --}}
    <div class="auth-panel">
        <div class="auth-box fade-in">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="auth-logo">
                <img src="{{ asset('storage/artists/LOGOF6.jpg') }}" alt="Logo">
            </a>

            <h2 class="auth-title">Nouveau mot de passe</h2>

            <form method="POST" action="{{ route('password.store') }}" class="auth-form">
                @csrf

                {{-- TOKEN --}}
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                {{-- EMAIL --}}
                <input
                    type="email"
                    name="email"
                    placeholder="Adresse e-mail"
                    value="{{ old('email', request('email')) }}"
                    required
                >

                {{-- MOT DE PASSE --}}
                <div class="password-field">
                    <input
                        type="password"
                        name="password"
                        placeholder="Nouveau mot de passe"
                        required
                    >
                    <span class="toggle-password">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>

                {{-- CONFIRMATION --}}
                <div class="password-field">
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirmer le mot de passe"
                        required
                    >
                    <span class="toggle-password">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>

                <button type="submit" class="btn-gold">
                    Réinitialiser
                </button>
            </form>

            <p class="auth-footer">
                Mot de passe retrouvé ?
                <a href="{{ route('login') }}">Connexion</a>
            </p>

        </div>
    </div>

</section>

{{-- SCRIPT OEIL --}}
<script>
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.previousElementSibling;
        const icon = btn.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});
</script>

@endsection
