@extends("layouts.app")

@section("content")

<h3>Modification de vol:</h3>
<div>
Avion: {{ $flight->plane->model }} ({{ $flight->plane->registration }})
</div>
<div>
    <form action="{{ route('flight.update', $flight->id) }}" method="post">
        @csrf
        @method('put')
        <label for="departure">Heure de départ: </label>
        <input type="time" name="departure" id="departure" value="{{ date("H:i",strtotime($flight->departure)) }}">
        <input type="submit" />
    </form>
<div>
<div>
    Passager:
    @foreach ($flight->users as $u)
        <form action="{{route('flight.removePassenger')}}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $u->id }}">
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
            <label for="Enlever">{{ $u->name }}</label>
            <input type="submit" name="submit" value="Enlever">
        </form>
    @endforeach


</div>
<div>
    <form action="{{route('flight.addPassenger')}}" method="post">
        @csrf
        <input type="hidden" name="flight_id" value="{{ $flight->id }}">
        <label for="inputTitle">Ajouter un passsager: </label>
        <input list="users" name="email" >
        <datalist id="users">
            @foreach ($users as $u)
            <option value="{{$u->email}}">{{$u->name}}</option>
            @endforeach
        </datalist>
        <input type="submit" name="submit" value="Ajouter">
    </form>
</div>
@if ($errors->any())
<div class="alert alert-danger mt-3 col-12">
    <strong>Whoops!</strong> Il y a un problème avec vos entrées.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection
