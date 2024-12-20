@extends('layouts.master')

<!-- <td>{{ $prenotazione->arrivo }}</td>
                        <td>{{ $prenotazione->partenza }}</td>
                        <td>{{ $prenotazione->numAdulti }}</td>
                        <td>{{ $prenotazione->numBambini }}</td>
                        <td>{{ $prenotazione->prezzoTotale }}</td>
                        <td>{{ $prenotazione->nome }}</td>
                        <td>{{ $prenotazione->cognome }}</td>
                        <td>{{ $prenotazione->orarioArrivo }}</td> -->
@section('titolo')
Dettagli Prenotazione
@endsection

@section('active_prenotazioniAdmin','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prenotazioniAdmin.index') }}">Prenotazioni Admin</a></li>
<li class="breadcrumb-item active" aria-current="page">Dettagli prenotazione</li>
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
                                <h1>Dettagli prenotazione:</h1>
                            </div>
                        </div>
                    </div>

                    <div id="inner">
                        <div class="container-fluid px-lg-4 mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="row justify-content-between text-center">
                                        <div class="col-md-5" style="display: flex; flex-direction: column;align-items: center;">
                                            <h4 class="mb-4">Dati della prenotazione</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Arrivo:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ \Carbon\Carbon::parse($prenotazione->arrivo)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Partenza:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ \Carbon\Carbon::parse($prenotazione->partenza)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Orario Arrivo:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ \Carbon\Carbon::parse($prenotazione->orarioArrivo)->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5" style="display: flex; flex-direction: column;align-items: center;">
                                            <h4 class="mb-4">Numero di ospiti</h4>
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
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    <div class="row justify-content-center text-center">
                                        <div class="col-md-10" style="display: flex; flex-direction: column;align-items: center;">
                                            <!-- Dati personali -->
                                            <h4 class="mb-4">Dati personali</h4>
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
                                                    <b>Prezzo:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    €{{ $prenotazione->prezzoTotale }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row mb-3 justify-content-center text-center">
                                    <div class="col-md-8">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a class="btn btn-danger w-100" href="{{ route('prenotazioniAdmin.destroy.confirm', ['id' => $prenotazione->id]) }}"><i class="bi bi-trash"></i> Elimina</a>
                                            </div>
                                        </div>

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
    </div>
</section>


@endsection

