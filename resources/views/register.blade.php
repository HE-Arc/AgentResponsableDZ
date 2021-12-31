@extends("layouts.app")
@section("content")
<div class="form-group">

<form method="POST" action="{{ route('register') }}">
    @csrf
        <div class="row">
            <label for="name">Nom</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                />

            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="row">
            <label for="surname">Surnom</label>
            <input
                type="text"
                name="surname",
                value="{{ old('surname') }}"
                required
                />

            @error('surname')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="row">
            <label for="phone_number">numéro de téléphone</label>
            <input
                type="phone"
                name="phone_number"
                value="{{ old('phone_number') }}"
                required
                />

            @error('phone_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="row">
            <label for="email">email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                />

            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="row">
            <label for="password">mot de passe</label>

            <input
                type="password"
                name="password"
                required
                />
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="row">
            <label for="password_confirmation">confirmer mot de passe</label>
            <input
                type="password"
                name="password_confirmation"
                required
                />

            @error('confirm_password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="row">
            <input type="submit" value="soumettre"></input>
        </div>
    </form>

    <a>mot de passe oublié ?</a>
</div>
@endsection
