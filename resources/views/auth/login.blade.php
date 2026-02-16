@extends('layouts.app')

@section('title', 'Connexion')

@section('content')

<section class="auth-full"
    style="background-image: url('{{ asset('storage/artists/Tazo2.jpg') }}');">

    {{-- COLONNE VISUELLE GAUCHE --}}
    <div class="auth-visual">

        <div class="auth-visual-content">
            <h1>Underground<br>But Rising</h1>
            <p>Connecte-toi pour découvrir et soutenir  les artistes underground.</p>

            <a href="{{ route('home') }}" class="visual-home">
                ← Retour à l’accueil
            </a>
        </div>

    </div>


    {{-- COLONNE FORMULAIRE DROITE --}}
    <div class="auth-panel">

        <div class="auth-box">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="auth-logo">
                <img src="{{ asset('storage/artists/LOGOF6.jpg') }}" alt="Logo">
            </a>

            <h2 class="auth-title">Connexion</h2>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                {{-- EMAIL --}}
                <input
                    type="email"
                    name="email"
                    placeholder="Adresse e-mail"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >

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


                {{-- REMEMBER + FORGOT --}}
                <div class="terms" style="justify-content: space-between; align-items:center;">
                    <label style="display:flex; gap:6px; align-items:center;">
                        <input type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                {{-- BOUTON --}}
                <button type="submit" class="btn-gold">
                    Se connecter
                </button>

            </form>

            <p class="auth-footer">
                Pas encore de compte ?
                <a href="{{ route('register') }}">Inscription</a>
            </p>

        </div>

    </div>
        
    <script>
document.addEventListener('click', function (e) {

    const toggle = e.target.closest('.toggle-password');
    if (!toggle) return;

    const field = toggle.closest('.password-field');
    const input = field.querySelector('input');

    if (input.type === 'password') {
        input.type = 'text';
        toggle.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        input.type = 'password';
        toggle.innerHTML = '<i class="fa-solid fa-eye"></i>';
    }

});
</script>

</section>

@endsection
