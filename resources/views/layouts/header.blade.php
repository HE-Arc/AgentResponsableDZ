<header class="container sticky-top">
    <div class="row" id="header-image">
        <div class="col-1">
            <a href="{{ route('home') }}">
                <img id="imgLogo" src="/images/logo.png">
            </a>
        </div>

        <div class="col-10 align-self-center">
            @auth
            <span class="d-flex justify-content-center text-center"><strong>Bienvenue, {{ auth()->user()->surname }} !</strong></span>
            @endauth
        </div>
        <div class="col-1 align-self-center">
            <nav class="navbar">
                <div class="container-fluid">
                    <button onClick="toggleNavBar();">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="collapse navbar-collapse" id="navbarLinks">
                <div class="bg-light shadow-3 p-2">
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
                    <div class="row">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-alert" type="submit">se déconnecter</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>


<script src="{{ asset('js/header.js') }}" type="text/javascript" ></script>
