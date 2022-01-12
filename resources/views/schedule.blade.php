@extends("layouts.app")
@section("content")
<?php
use App\Http\Controllers\FlightController;
$counter = 0;
?>
@if(sizeof($flights)==0)
    <div class="alert alert-info">Aucun avion n'est prévu pour le moment</div>
@else
    <div class="row">
        <div class="col border bg-light">Avion</div>
        <div class="col border bg-light">Départ</div>
        <div class="col border bg-light">Booking</div>
        @if (isset($user))
            <div class="col border bg-light">Rejoindre</div>
        @endif
        @if (isset($user) && $user->is_RDZ)
            <div class="col border bg-light">Modifier</div>
        @endif
        <div class="col border bg-light">Avion n°</div>
    </div>

    @foreach ($flights as $f)
    <div class="row @if ($counter++ % 2 == 0) bg-light @else bg-warning @endif">
        <div class="col">
            {{ $f->plane->model }}
        </div>
        <div class="col">{{ date("H:i",strtotime($f->departure)) }}</div>
        <div class="col">{{ count($f->users) }}/{{ $f->plane->seat_count}}</div>
        @if (isset($user))
        <div class="col">
            @if(!FlightController::in_flight($user,$f))
                <form action="{{ route('flight.join') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="flight_id" value="{{ $f->id }}"/>
                    <input type="hidden" name="flight_type" value="4000"/>
                    <button type="submit" class="btn btn-primary" @if(!(strtotime($f->departure) > strtotime(Date::now()) ||  count($f->users) >= $f->plane->seat_count)) disabled @endif>4000m</button>
                </form>
                @if($user->credits1500 > 0)
                <form action="{{ route('flight.join') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="flight_id" value="{{ $f->id }}"/>
                    <input type="hidden" name="flight_type" value="1500"/>
                    <button type="submit" class="btn btn-secondary" @if(!(strtotime($f->departure) > strtotime(Date::now()) ||  count($f->users) >= $f->plane->seat_count)) disabled @endif>1500m</button>
                </form>
                @endif
            @else
                <form action="{{ route('flight.leave') }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="flight_id" value="{{ $f->id }}"/>
                <button type="submit" class="btn btn-danger" @if(!(strtotime($f->departure) > strtotime(Date::now()) ||  count($f->users) >= $f->plane->seat_count)) disabled @endif>Quitter</button>
            </form>
            @endif
        </div>
        @endif
        @if (isset($user) && $user->is_RDZ)
            <div class="col"><a href="{{ route('flight.edit',$f->id) }}">Modifier</a></div>
        @endif
        <div class="col"><a href="{{route('flight.show',$f->id)}}">{{$counter}}</a></div>
    </div>
    @endforeach
@endif
@if (isset($user) && $user->is_RDZ)
    <a href="{{ route('flight.create') }}">Ajouter un vol</a>
@endif


@endsection

