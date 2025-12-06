<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Underground but Rising</title>

    <!-- CSS principal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
     <link rel="stylesheet" href="{{ asset('css/new.css') }}">
     <link rel="stylesheet" href="{{ asset('css/news-show.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('storage/artists/LOGO.jpg') }}" alt="Underground Rising" class="logo-img">
            </a>
        </div>

        <ul>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('artists.index') }}">Artistes</a></li>
            <li><a href="{{ route('news.index') }}">Actualités</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>

            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button style="background:none;border:none;color:white;cursor:pointer;">
                            Déconnexion
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Connexion</a></li>
                <li><a href="{{ route('register') }}">Inscription</a></li>
            @endauth
        </ul>
    </nav>

    <!-- CONTENU DES PAGES -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('storage/artists/LOGO.jpg') }}" alt="Underground Rising" class="logo-img">
            </a>
        </div>

        <div class="footer-container">
            <div class="footer-links">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('artists.index') }}">Artistes</a>
                <a href="{{ route('news.index') }}">Actualités</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>

            <div class="footer-social">
                <a href="https://facebook.com" target="_blank">Facebook</a>
                <a href="https://instagram.com" target="_blank">Instagram</a>
                <a href="https://youtube.com" target="_blank">YouTube</a>
            </div>

            <p class="footer-copy">
                © {{ date('Y') }} Projet2Soutenance Underground but Rising. Tous droits réservés.
            </p>
        </div>
    </footer>

</body>
</html>
