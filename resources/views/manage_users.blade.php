@extends("layouts.app")

@section("content")

<div class="row">
    <h3>Modifier les utilisateurs:</h3>
</div>

<div class="row">
    <label for="user">Utilisateur à modifier :</label>

    <select id="users" onChange="userChanged();">
        @foreach ($users as $u)
        <option value="{{$u->email}}">{{$u->name}}</option>
        @endforeach
    </select>

    <form method="post" action="{{ route('user.update_from_admin', auth()->user()->id)}}">
        @csrf
        @method("put")

        <input type="hidden" name="id" id="user_to_change"></input>

        <label for="name">Nom</label>

        <div class="row">
            <input
                type="text"
                id="name"
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
                id="surname"
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
                id="phone_number"
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
                id="email"
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
        </div>
        <div class="row">

            <label for="isRDZ">Est un responsable de DZ</label>
            <input
            type="checkbox"
            id="isRDZ"
            name="isRDZ"
             />
            @error('isRDZ')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="row">

            <label for="credits1500">Crédits sauts a 1500m</label>
            <input
            type="number"
            id="credits1500"
            name="credits1500"
            value="{{ old('credits4000') }}"
            required />
            @error('credits1500')
            <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>
        <div class="row">

            <label for="credits4000">Crédits sauts a 4000m</label>

            <input
            type="number"
            id="credits4000"
            name="credits4000"
            value="{{ old('credits4000') }}"
            required />
            @error('credits4000')
            <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>
        <div class="row">
            <input type="submit" value="valider"></input>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript" src="{{ asset('js/manage_users.js') }}"></script>
@endpush
@endsection
