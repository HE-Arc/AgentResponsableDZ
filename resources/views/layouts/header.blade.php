<header>
    <img id="imgLogo" src="/images/logo.png">
    @guest
    <a href="{{ route('login') }}">se connecter</a>
    <a href="{{ route('register') }}">crée un compte</a>
    @endguest
    @auth
    <span>Welcome, {{ auth()->user()->surname }} !</span>
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <input type="submit" value="se déconnecter"></a>
    </form>

    <a href="{{ route('user.edit', auth()->user()->id) }}">Modifier le profil</a>
    @endauth
</header>
