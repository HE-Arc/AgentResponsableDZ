@extends("layouts.app")

@section("content")
    <div>{{ $flight->plane->model }} <strong>Vol nr° {{ $flight->plane->id }}</strong></div>
    <div><img src="/images/dummyPlane.jpg" height="150px"/>Status:
        @if (strtotime($flight->departure) < strtotime(Date::now()) /*If the flight already departed*/)
        <i class="fas fa-check-circle"></i>
    @else
        <i class="fas fa-times-circle"></i>
    @endif</div>
    <div>Heure de décolage : <br>{{ date("H:m d.m.y",strtotime($flight->departure)) }}
    <h3>Passagers : </h3>
    @foreach ($flight->users as $u)
        {{ $u->name }}<br>
    @endforeach

    @if(isset($user) && /*If user is logged in*/
    strtotime($flight->departure) > strtotime(Date::now() && /* If plane is not already departed*/
    count($flight->users) < $flight->plane->seat_count) && /* If plane is not full*/
    $user->credits4000 > 0 && $user->credits1500 > 0 /*If user isn't poor*/)
        <button>s'inscrire</button>
    @endif

@endsection
