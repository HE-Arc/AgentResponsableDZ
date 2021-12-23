@extends("layouts.app")

@section("content")

<h3>Modification de vol:</h3>
<div>
Avion: {{ $flight->plane->model }} ({{ $flight->plane->registration }})
</div>
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
