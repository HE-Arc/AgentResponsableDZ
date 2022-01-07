@extends("layouts.app")
@section("content")
<?php
use App\Http\Controllers\FlightController;
?>

<table>
    <tr>
        <td>Avion</td>
        <td>Départ</td>
        <td>Booking</td>
        <td>Avion n°</td>
        @if (isset($user))
            <td>Rejoindre</td>
        @endif
    </tr>
    @foreach ($flights as $f)

    <tr>
        <td>

        @if (strtotime($f->departure) < strtotime(Date::now()) /*If the flight already departed*/)
            <i class="fas fa-check-circle"></i>
        @else
            <i class="fas fa-times-circle"></i>
        @endif
        </td>
        <td>{{ date("H:i",strtotime($f->departure)) }}</td>
        <td>{{ count($f->users) }}/{{ $f->plane->seat_count}}</td>
        <td>{{ $f->id }}</td>
        @if (isset($user))
        <td>
            @if(strtotime($f->departure) < strtotime(Date::now() ) ||  count($f->users) >= $f->plane->seat_count ||   FlightController::in_flight($user,$f)/*If the flight already departed*/)
            @elseif($user->credits4000 >= 0)
            <form action="{{ route('flight.join') }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="flight_id" value="{{ $f->id }}"/>
                <input type="hidden" name="flight_type" value="4000"/>
                <button type="submit">4000</button>
            </form>
            @elseif($user->credits1500 <= 0)
            <form action="{{ route('flight.join') }}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="flight_id" value="{{ $f->id }}"/>
                <input type="hidden" name="flight_type" value="1500"/>
                <button type="submit">1500</button>
            </form>
            @endif
        </td>
        @endif
    </tr>
    @endforeach

</table>
@endsection

