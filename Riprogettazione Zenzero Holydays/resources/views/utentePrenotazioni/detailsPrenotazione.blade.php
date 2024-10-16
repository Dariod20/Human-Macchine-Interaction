@extends('layouts.master')


@section('titolo')
Dettagli Prenotazione
@endsection

@section('active_prenotazioniUtente','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prenotazioniUtente.index') }}">Prenotazioni</a></li>
<li class="breadcrumb-item active" aria-current="page">Dettagli prenotazione</li>
@endsection

@section('corpo')
<div class="container-fluid mb-3 pt-3">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <h1>Dettagli prenotazione:</h1>
        </div>
    </div>
</div>

<div class="container-fluid px-lg-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Arrivo:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->arrivo }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Partenza:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->partenza }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Nome:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->nome }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Cognome:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->cognome }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Numero Adulti:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->numAdulti }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Numero Bambini:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->numBambini }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Prezzo:</b>
                </div>
                <div class="col-md-8">
                    €{{ $prenotazione->prezzoTotale }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>E-mail:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->email }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Telefono:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->telefono }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Stato:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->stato }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Orario Arrivo:</b>
                </div>
                <div class="col-md-8">
                    {{ $prenotazione->orarioArrivo }}
                </div>
            </div>
        </div>

        <div class="col-md-2">
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <a class="btn btn-danger w-100" href="{{ route('prenotazioniUtente.destroy.confirm', ['id' => $prenotazione->id]) }}"><i class="bi bi-trash"></i>{{ trans('button.elimina') }}</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i class="bi bi-box-arrow-left"></i>{{ trans('button.annulla') }}</a>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

