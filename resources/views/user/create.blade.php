@extends("layouts.app")
@section("content")
<div class="form-group">
<form method="POST" action="{{ route('user.store') }}">
    @csrf
        <div class="block">
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                />
            <label for="name">Nom</label>
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="block">
            <input
                type="text"
                name="surname",
                value="{{ old('surname') }}"
                required
                />
            <label for="surname">Surnom</label>
            @error('surname')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="block md-6">
            <input
                type="phone"
                name="phone_number"
                value="{{ old('phone_number') }}"
                required
                />
            <label for="phone_number">numéro de téléphone</label>
            @error('phone_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="block">
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                />
            <label for="email">email</label>
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="block">
            <input
                type="password"
                name="password"
                required
                />
            <label for="password">mot de passe</label>
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="block">
            <input
                type="password"
                name="password_confirmation"
                required
                />
            <label for="email">confirmer mot de passe</label>
            @error('confirm_password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="block">
            <input type="submit" value="soumettre"></input>
        </div>

    </form>
</div>
@endsection
