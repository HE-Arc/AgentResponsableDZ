@extends("layouts.app")
@section("content")
<form action="{{route('flight.store')}}" method="POST">
    @csrf

    <div class="row">
        <div class="col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card">
                <div class="card-header">
                Nouveau vol:
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="inputTitle">Avion: </label>
                                <input list="planes" name="plane" class="form-control" >
                                <datalist id="planes">
                                    @foreach ($planes as $p)
                                    <option value="{{ $p->model }} ({{$p->registration}})">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group col-6">
                                <label for="departure">Heure de départ: </label>
                                <input type="time" name="departure" class="form-control" id="departure">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Envoyer</button>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
