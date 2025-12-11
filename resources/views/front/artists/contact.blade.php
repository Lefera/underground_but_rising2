@extends('layouts.app')

@section('content')

<div class="contact-container">

    <h2 class="contact-title">Contacter {{ $artist->name }}</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" class="contact-form">
        @csrf

        <div class="form-group">
            <label class="form-label">Votre email</label>
            <input type="email" name="email" class="form-input" required placeholder="Entrez votre adresse email">
        </div>

        <div class="form-group">
            <label class="form-label">Votre message</label>
            <textarea name="message" class="form-textarea" required minlength="10" placeholder="Écrivez votre message ici..."></textarea>
        </div>

        <button type="submit" class="btn-send">Envoyer le message</button>
    </form>

</div>

@endsection
