@extends('layouts.app')

@section('title', 'Inscription')

@section('content')

<section class="auth-full"
    style="background-image: url('{{ asset('storage/artists/Tazo2.jpg') }}');">

    {{-- COLONNE GAUCHE VISUEL --}}
    <div class="auth-visual">
        <div class="auth-visual-content">
            <h1>Underground<br>But Rising</h1>
            <p>La plateforme qui révèle les artistes de demain.</p>

            <a href="{{ route('home') }}" class="visual-home">
                ← Retour à l’accueil
            </a>
        </div>
    </div>

    {{-- COLONNE DROITE FORM --}}
    <div class="auth-panel">
        <div class="auth-box">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="auth-logo">
                <img src="{{ asset('storage/artists/LOGOF6.jpg') }}" alt="Logo">
            </a>

            <h2 class="auth-title">Créer un compte</h2>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="Nom complet"
                    required
                    value="{{ old('name') }}"
                >

                <input
                    type="email"
                    name="email"
                    placeholder="Adresse e-mail"
                    required
                    value="{{ old('email') }}"
                >

                {{-- MOT DE PASSE --}}
                <div class="password-field">
                    <input
                        type="password"
                        name="password"
                        placeholder="Mot de passe"
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

                {{-- CONDITIONS --}}
                <label class="terms">
                    <input type="checkbox" name="terms" required>
                    <span>
                        J’accepte les
                        <a href="{{ route('legal.terms') }}" target="_blank">conditions</a>
                        et la
                        <a href="{{ route('legal.privacy') }}" target="_blank">politique de confidentialité</a>
                    </span>
                </label>

                <button type="submit" class="btn-gold">
                    S’inscrire
                </button>
            </form>

            <p class="auth-footer">
                Déjà inscrit ?
                <a href="{{ route('login') }}">Connexion</a>
            </p>

        </div>
    </div>


    <script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.toggle-password').forEach(toggle => {

        toggle.addEventListener('click', function () {

            const input = this.parentElement.querySelector('input');

            if (input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                this.innerHTML = '<i class="fa-solid fa-eye"></i>';
            }

        });

    });

});
</script>

</section>

@endsection
