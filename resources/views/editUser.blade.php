@extends("layouts.app")

@section("content")

<h3>Modification de l'utilisateur:</h3>
<div class="container">
    <div class="row">
        <form action="{{ route('user.update', auth()->user()->id) }}" method="post">
            <div class="row">
                <label for="name">Nouvea nom: </label>
                <input type="text" name="name" value="{{ auth()->user()->name }}">
            </div>
            <div class="row">
                <label for="surname">Nouveau surnom: </label>
                <input type="text" name="surname" value="{{ auth()->user()->surname }}">
            </div>
            <div class="row">
                <label for="email">Nouveau mail: </label>
                <input type="mail" name="email" value="{{ auth()->user()->email }}">
            </div>
            <div class="row">
                <label for="phone_number">Nouveau numéro de téléphone: </label>
                <input type="phone" name="phone_number" value="{{ auth()->user()->phone_number }}">
            </div>
            <input type="submit" value="valider"/>
        </form>
    </div>
    <div class="row">
        <form method="post" action="{{/*route('user.update_password'*/ '/'}}">
            <div class="row">
                <label for="password">Nouveau mot de passe: </label>
                <input type="password" name="password"></input>
            </div>
            <div class="row">
                <label for="password_confirm">Confirmer nouveau mot de passe: </label>
                <input type="password" name="password_confirm"></input>
            </div>
            <input type="submit" value="valider" />
        </form>
    </div>
</div>
@endsection
