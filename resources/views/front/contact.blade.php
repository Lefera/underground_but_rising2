@extends('layouts.app')

@section('content')
<section class="contact-section">

    <h2 class="contact-title"><i class="fas fa-envelope"></i> Contact</h2>
    <p class="contact-subtitle">Une question ? Une suggestion ? Nous sommes à votre écoute.</p>

    <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
        @csrf

        <!-- Anti-robots (honeypot) -->
        <input type="text" name="website" class="honeypot">

        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Votre nom" required>
        </div>

        <div class="input-group">
            <i class="fas fa-at"></i>
            <input type="email" name="email" placeholder="Votre email" required>
        </div>

        <div class="input-group">
            <i class="fas fa-tag"></i>
            <input type="text" name="subject" placeholder="Sujet du message" required>
        </div>

        <div class="input-group textarea">
            <i class="fas fa-comment-dots"></i>
            <textarea name="message" placeholder="Votre message..." required></textarea>
        </div>

        <button type="submit" class="btn-contact">
            <i class="fas fa-paper-plane"></i> Envoyer
        </button>
    </form>

</section>
@endsection
