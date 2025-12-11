<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Underground but Rising</title>

    <!-- CSS principal -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/new.css') }}">
    <link rel="stylesheet" href="{{ asset('css/news-show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/artist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/artistshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/revelation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admincontact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminmessage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/politiqueconfig.css') }}">
    <link rel="stylesheet" href="{{ asset('css/genreshow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
     <link rel="stylesheet" href="{{ asset('css/form-contacter-artists.css') }}">

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
            <li><a href="/revelations" class="active">Révélations</a></li>
            <li><a href="{{ route('news.index') }}">Actualités</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
           
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                <li><a href="/revelations" class="active">Révélations</a></li>
                <a href="{{ route('news.index') }}">Actualités</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="{{ route('mentions.legales') }}">Mentions légales</a>
                <a href="{{ route('politique.confidentialite') }}">Politique de confidentialité</a>
            </div>

            <div class="footer-social">
                <a href="https://www.instagram.com/undergroundbutrising/" target="_blank">@undergroundbutrising</a>
            </div>

            <p class="footer-copy">
                © {{ date('Y') }} Projet2Soutenance Underground but Rising. Tous droits réservés.
            </p>
        </div>
    </footer>

</body>
</html>
