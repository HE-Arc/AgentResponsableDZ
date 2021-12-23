<header>
    <img id="imgWave" src="/images/header_image.png"/>
    <img id="imgLogo" src="/images/logo.png">

    @guest
    <a href="{{ route('login') }}">se connecter</a>
    <a href="{{ route('register') }}">crée un compte</a>
    @endguest
    @auth
    <span>Welcome, {{ auth()->user()->name }} !</span>
    <form method="post" action="{{ route('logout')}}">
        @csrf
        <input type="submit" value="se déconnecter"></a>
    </form>
    @endauth
</header>
