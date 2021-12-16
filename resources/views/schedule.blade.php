@extends("layouts.app")
@section("content")
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
            <img src="/images/schedule/landed.png"/>
        @else
            <img src="/images/schedule/loadingPlane.png"/>
        @endif
        </td>
        <td>{{ date("H:m",strtotime($f->departure)) }}</td>
        <td>{{ count($f->users) }}/{{ $f->plane->seat_count}}</td>
        <td>{{ $f->id }}</td>
        @if (isset($user))
            @if(strtotime($f->departure) < strtotime(Date::now()) /*If the flight already departed*/)
                <img src="/images/schdule/joinPlaneDeparted.png"/>
            @elseif (count($f->users) >= $f->plane->seat_count /*If the flight is full*/)
                <img src="/images/schdule/joinPlaneFull.png"/>
            @elseif($user->credits4000 <= 0 && $user->credits1500 <= 0  /*If there is space but the user is poor*/)
                <img src="/images/schdule/joinPlaneNoCredits.png"/>
            @else
                <img src="/images/schdule/joinPlaneOK.png"/>
            @endif
        @endif
    </tr>
    @endforeach

</table>
@endsection

