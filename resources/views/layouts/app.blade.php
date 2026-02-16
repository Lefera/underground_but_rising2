<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Underground but Rising</title>

    <!-- ================= GLOBAL ================= -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
     <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/legal.css') }}">
    <!-- ================= CONTENT ================= -->
    <link rel="stylesheet" href="{{ asset('css/new.css') }}">
    <link rel="stylesheet" href="{{ asset('css/news-show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/genreshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tracks.css') }}">

    <!-- ================= ARTISTS ================= -->
    <link rel="stylesheet" href="{{ asset('css/artist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/artistshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/revelation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-contacter-artists.css') }}">

    <!-- ================= AUTH / ADMIN ================= -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/messaging.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admincontact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminmessage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    

   
</head>

<body>

{{-- =====================================================
   NAVBAR
===================================================== --}}
<nav class="navbar">
    <div class="navbar-inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="navbar-logo">
            <img src="{{ asset('storage/artists/LOGOF1.jpg') }}" alt="Underground Rising">
        </a>

        {{-- Menu principal --}}
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('artists.index') }}">Artistes</a></li>
            <li><a href="/revelations">Révélations</a></li>
            <li><a href="{{ route('news.index') }}">Actualités</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>

        {{-- Zone utilisateur --}}
        <ul class="navbar-auth">

        @auth

            @if(auth()->user()->isAdmin())
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-badge">
                        Dashboard
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('messages.inbox') }}">
                    <i class="fa-solid fa-inbox"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('messages.sent') }}">
                    <i class="fa-solid fa-paper-plane"></i>
                </a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-auth">Déconnexion</button>
                </form>
            </li>

        @else

            <li><a href="{{ route('login') }}" class="btn-auth">Connexion</a></li>
            <li><a href="{{ route('register') }}" class="btn-auth">Inscription</a></li>

        @endauth

        </ul>
    </div>
</nav>


{{-- =====================================================
   CONTENU PAGE
===================================================== --}}
<main class="main-content">
    @yield('content')
</main>


{{-- =====================================================
   FOOTER
===================================================== --}}
<footer class="footer">

    <div class="footer-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('storage/artists/LOGOF1.jpg') }}" alt="Underground Rising">
        </a>
    </div>

    <div class="footer-container">

        <nav class="footer-links">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('artists.index') }}">Artistes</a>
            <a href="/revelations">Révélations</a>
            <a href="{{ route('news.index') }}">Actualités</a>
            <a href="{{ route('contact') }}">Contact</a>
           <a href="{{ route('legal.privacy') }}">Politique de confidentialité</a>
            <a href="{{ route('legal.terms') }}">Conditions d’utilisation</a>
            <a href="{{ route('legal.mentions') }}">Mentions légales</a>
        </nav>

        <div class="footer-social">
            <a href="https://www.instagram.com/undergroundbutrising/" target="_blank">
                @undergroundbutrising
            </a>
        </div>

        <p class="footer-copy">
            © {{ date('Y') }} Underground But Rising – Tous droits réservés
        </p>

    </div>
</footer>


{{-- =====================================================
   SCRIPT NAVBAR SCROLL
===================================================== --}}
<script>
window.addEventListener("scroll", () => {
    document
        .querySelector(".navbar")
        .classList.toggle("scrolled", window.scrollY > 30);
});
</script>

</body>
</html>
