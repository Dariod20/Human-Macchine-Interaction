@extends('layouts.delete') 

@section('titolo')
    Elimina Tariffa
@endsection

@section('active_tariffeAdmin','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('tariffeAdmin.index') }}">Tariffe</a></li>
<li class="breadcrumb-item active" aria-current="page">Elimina tariffa</li>
@endsection


@section('corpo')
    <div class="container-fluid px-lg-4 mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>
                    Stai per cancellare la tariffa per il giorno {{ $tariffa->giorno }} dalla lista.
                </h2>
                <p class="confirm">
                    Confermi?
                </p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-5">
                <div class="card border-secondary">
                    <div class="card-header text-center">
                        Conferma
                    </div>
                    <div class="card-body text-center">
                        <p>
                            La tariffa <strong>sarà rimossa permanentemente</strong> dal database.
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Giorno:</strong> {{ $tariffa->giorno }}</li>
                            <li><strong>Prezzo:</strong> {{ $tariffa->prezzo }}</li>
                        </ul>
                        <form name="tariffa" method="post" action="{{ route('tariffeAdmin.destroy', ['tariffeAdmin' => $tariffa->id]) }}">
                            @method('DELETE')
                            @csrf
                            <label for="mySubmit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> Elimina</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card border-secondary">
                    <div class="card-header text-center">
                        Annulla
                    </div>
                    <div class="card-body text-center">
                        <p>
                            La tariffa <strong>non sarà rimossa</strong> dal database.
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Giorno:</strong> {{ $tariffa->giorno }}</li>
                            <li><strong>Prezzo:</strong> {{ $tariffa->prezzo }}</li>
                        </ul>
                        <a class="btn btn-secondary w-100" href="{{ route('tariffeAdmin.index') }}"><i class="bi bi-box-arrow-left"></i> Annulla</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
