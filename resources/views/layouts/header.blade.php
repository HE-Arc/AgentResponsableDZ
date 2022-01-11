<header class="container sticky-top">
    <div class="row" id="header-image">
        <div class="col-1">
            <a href="{{ route('home') }}">
                <img id="imgLogo" src="/images/logo.png">
            </a>
        </div>

        <div class="col-5 align-self-center">
            @auth
            <span class="d-flex justify-content-center text-center"><strong>Bienvenue, {{ auth()->user()->surname }} !</strong></span>
            @endauth
        </div>
        <div class="col-5 align-self-center">
            @auth
            <div class="row">
                <span class="d-flex justify-content-center text-center">Crédits 4000m: {{ auth()->user()->credits4000 }}</span>
            </div>
            <div class="row">
                <span class="d-flex justify-content-center text-center">Crédits 1500m: {{ auth()->user()->credits1500 }}</span>
            </div>
            @endauth
        </div>
        <div class="col-1 align-self-center">
            <nav class="d-flex justify-content-end">
                <div class="container-fluid">
                    <button onClick="toggleNavBar();">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
        </div>
    </div>
    <div class="row collapse navbar-collapse" id="navbarLinks">
        <div class="container bg-light shadow-3 p-2">
            <div class="row">
            <div class="col">
                @guest
                <div class="row">
                    <a class="link-dark" href="{{ route('login') }}">se connecter</a>
                </div>
                <div class="row">
                    <a class="link-dark" href="{{ route('register') }}">crée un compte</a>
                </div>
                @endguest
                @auth
                <div class="row">
                    <a class="link-dark" href="{{ route('user.edit', auth()->user()->id) }}">Modifier le profil</a>
                </div>
                @if(auth()->user()->is_RDZ)
                <div class="row">
                    <a class="link-dark" href="{{ route('user.manage', auth()->user()->id) }}">Manage les utilisateurs</a>
                </div>
                @endif
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger" type="submit">se déconnecter</button>
                    </form>
                </div>
            </div>
            </div>
            @endauth
        </div>
    </div>
</header>


<script src="{{ asset('js/header.js') }}" type="text/javascript" ></script>
