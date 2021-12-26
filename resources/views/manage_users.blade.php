@extends("layouts.app")

@section("content")

<div class="container">
    <h3>Modifier les utilisateurs:</h3>

    <div>
        <label for="user">Utilisateur à modifier :</label>
        <input list="users" name="user" id="user">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <datalist id="users">
            @foreach ($users as $u)
            <option value="{{$u->email}}">{{$u->name}}</option>
            @endforeach
        </datalist>

        <form method="post" action="{{ route('user.update_from_admin')}}"
            @csrf
            @method("put")

        </form>
    </div>
</div>


@endsection
