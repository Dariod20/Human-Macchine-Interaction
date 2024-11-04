@extends('layouts.master')


@section('titolo')
Dettagli Prenotazione
@endsection

@section('active_prenotazioni','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('tariffeAdmin.index') }}">Tariffe</a></li>
<li class="breadcrumb-item active" aria-current="page">Dettagli tariffa</li>
@endsection

@section('corpo')

<section id="form-admin">
    <div class="container-fluid px-lg-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">

                    <div class="container-fluid mb-3 pt-3">
                        <div class="row justify-content-center">
                            <div class="col-md-10 text-center">
                                <h1>Dettagli Tariffa:</h1>
                            </div>
                        </div>
                    </div>

                    <div id="inner">
                        <div class="container-fluid px-lg-4 mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <b>Giorno:</b>
                                        </div>
                                        <div class="col-md-8">
                                            {{ \Carbon\Carbon::parse($tariffa->giorno)->format('d/m/Y') }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <b>Prezzo:</b>
                                        </div>
                                        <div class="col-md-8">
                                            {{ $tariffa->prezzo }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <b>Ospite:</b>
                                        </div>
                                        @if(isset($tariffa->prenotazione_id))
                                            <div class="col-md-8">
                                                {{ $tariffa->prenotazione->nome }} {{ $tariffa->prenotazione->cognome }}
                                            </div>
                                        @else
                                            <div class="col-md-8">Libero</div>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    @if(!isset($tariffa->prenotazione_id))
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a class="btn btn-primary w-100" href="{{ route('tariffeAdmin.edit', ['tariffeAdmin' => $tariffa->id]) }}"><i class="bi bi-pencil-square"></i> Modifica</a>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a class="btn btn-danger w-100" href="{{ route('tariffeAdmin.destroy.confirm', ['id' => $tariffa->id]) }}"><i class="bi bi-trash"></i> Elimina</a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i class="bi bi-box-arrow-left"></i> Annulla</a>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

@endsection

