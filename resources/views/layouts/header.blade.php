<header class="sticky-top">
    <div class="container">
        <a href="{{ route('home') }}">
            <img id="imgLogo" src="/images/logo.png">
        </a>


        @auth
        <span>Welcome, {{ auth()->user()->surname }} !</span>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <input type="submit" value="se déconnecter"></a>
        </form>
        @endauth

        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <button onClick="toggleNavBar();">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        <div class="collapse navbar-collapse" id="navbarLinks">
            <div class="bg-light shadow-3 p-2">
            @guest
            <div class="row">
                <a href="{{ route('login') }}">se connecter</a>
            </div>
            <div class="row">
                <a href="{{ route('register') }}">crée un compte</a>
            </div>
            @endguest
            @auth
            <div class="row">
                <a href="{{ route('user.edit', auth()->user()->id) }}">Modifier le profil</a>
            </div>
            @if(auth()->user()->is_RDZ)
            <div class="row">
                <a href="{{ route('user.manage', auth()->user()->id) }}">Manage les utilisateurs</a>
            </div>
            @endif
            @endauth
            </div>
        </div>
    </div>
</header>


<script src="{{ asset('js/header.js') }}" type="text/javascript" ></script>
