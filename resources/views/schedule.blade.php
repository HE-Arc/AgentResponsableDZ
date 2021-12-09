<x-layout>
    <table>
        @foreach ($flights as $f)
        <tr>
            <td>Avion</td>
            <td>Départ</td>
            <td>Booking</td>
            <td>n° {{ $f->id }}
        </tr>
        <tr>
            <td>
            @if (strtotime($f->departure) < strtotime(Date::now()))
                Departed
            @else
                Not Departed
            @endif
            </td>
            <td>{{ date("H:m",strtotime($f->departure)) }}</td>
            <td>{{ count($f->users) }}/{{ $f->plane->seat_count}}</td>
            <td>Booking</td>
        </tr>
        @endforeach
    </table>
</x-layout>
