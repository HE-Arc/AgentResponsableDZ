@extends("layouts.app")

@section("content")

<h3>Modification de l'utilisateur:</h3>
    <div class="row">
        <form action="{{ route('user.update', auth()->user()->id) }}" method="post">
            @csrf
            @method('put')

            <div class="row">
                <label for="name">Nouvea nom: </label>
                <input type="text" name="name" value="{{ auth()->user()->name }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <label for="surname">Nouveau surnom: </label>
                <input type="text" name="surname" value="{{ auth()->user()->surname }}">
                @error('surname')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <label for="phone_number">Nouveau numéro de téléphone: </label>
                <input type="phone" name="phone_number" value="{{ auth()->user()->phone_number }}">
                @error('phone_number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <input type="submit" value="valider"/>
            </div>
        </form>
    </div>
    <div class="row">
        <form method="post" action="{{ route('user.update_email', auth()->user()->id) }}">
            @csrf
            @method("put")
            <div class="row">
                <label for="email">Nouveau mail: </label>
                <input type="mail" name="email" value="{{ auth()->user()->email }}">
            </div>
            <div class="row">
                <label for="email_confirmation">Confirmer mail: </label>
                <input type="mail" name="email_confirmation" value="{{ auth()->user()->email }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <input type="submit" value="valider"/>
            </div>
        </form>
    </div>
    <div class="row">
        <form method="post" action="{{ route('user.update_password', auth()->user()->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <label for="password">Nouveau mot de passe: </label>
                <input type="password" name="password"></input>
            </div>
            <div class="row">
                <label for="password_confirmation">Confirmer nouveau mot de passe: </label>
                <input type="password" name="password_confirmation"></input>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <input type="submit" value="valider"/>
            </div>
        </form>
    </div>
@endsection
