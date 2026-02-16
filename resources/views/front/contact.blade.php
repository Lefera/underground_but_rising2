@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<section class="auth-full"
    style="background-image: url('{{ asset('storage/artists/Tazo2.jpg') }}');">

    {{-- COLONNE GAUCHE VISUEL --}}
    <div class="auth-visual">

        <div class="auth-visual-content">
            <h1>Contact</h1>
            <p>
                Une question, une collaboration ou un projet ?
                Écris-nous directement.
            </p>

            <a href="{{ route('home') }}" class="visual-home">
                ← Retour à l’accueil
            </a>
        </div>

    </div>


    {{-- COLONNE DROITE FORMULAIRE --}}
    <div class="auth-panel">

        <div class="auth-box contact-box">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="auth-logo">
                <img src="{{ asset('storage/artists/LOGOF6.jpg') }}" alt="Logo">
            </a>

            <h2 class="auth-title">Nous écrire</h2>

            <form method="POST" action="{{ route('contact.send') }}" class="auth-form">
                @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="Votre nom"
                    required
                >

                <input
                    type="email"
                    name="email"
                    placeholder="Votre e-mail"
                    required
                >

                <input
                    type="text"
                    name="subject"
                    placeholder="Sujet"
                    required
                >

                <textarea
                    name="message"
                    placeholder="Votre message..."
                    rows="5"
                    required
                ></textarea>

                <button type="submit" class="btn-gold">
                    Envoyer le message
                </button>

            </form>

            <p class="auth-footer">
                Réponse sous 24–48h
            </p>

        </div>

    </div>

</section>

@endsection
