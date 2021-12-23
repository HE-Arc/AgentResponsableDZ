@extends("layouts.app")
@section("content")
<div class="form-group">

<form method="POST" action="{{ route('login') }}">
    @csrf
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
            <input type="submit" value="se connecter"></input>
        </div>

    </form>
</div>
@endsection
