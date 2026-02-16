@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')

<section class="auth-full"
    style="background-image: url('{{ asset('storage/artists/Tazo2.jpg') }}');">

    {{-- VISUEL GAUCHE --}}
    <div class="auth-visual">
        <div class="auth-visual-content">
            <h1>Mot de passe oublié ?</h1>
            <p>Entre ton email pour recevoir un lien de réinitialisation.</p>

            <a href="{{ route('home') }}" class="visual-home">
                ← Retour à l’accueil
            </a>
        </div>
    </div>


    {{-- FORMULAIRE --}}
    <div class="auth-panel">

        <div class="auth-box">

            <a href="{{ route('home') }}" class="auth-logo">
                <img src="{{ asset('storage/artists/LOGOF6.jpg') }}" alt="Logo">
            </a>

            <h2 class="auth-title">Réinitialiser le mot de passe</h2>


            {{-- Message succès --}}
            @if (session('status'))
                <div class="auth-success">
                    {{ session('status') }}
                </div>
            @endif


            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf

                <input
                    type="email"
                    name="email"
                    placeholder="Adresse e-mail"
                    required
                    value="{{ old('email') }}"
                >
                

                <button type="submit" class="btn-gold">
                    Envoyer le lien
                </button>
            </form>

            <p class="auth-footer">
                <a href="{{ route('login') }}">← Retour à la connexion</a>
            </p>

        </div>

    </div>

</section>

@endsection
