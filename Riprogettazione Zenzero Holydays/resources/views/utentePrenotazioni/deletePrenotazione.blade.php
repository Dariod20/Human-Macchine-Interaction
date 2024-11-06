@extends('layouts.master')

@section('titolo')
    Elimina la tua prenotazione
@endsection

@section('active_prenotazioniUtente', 'active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prenotazioniUtente.index') }}">Prenotazioni</a></li>
<li class="breadcrumb-item active" aria-current="page">Elimina prenotazione</li>
@endsection

@section('corpo')

<section id="form-admin">
    <div class="container-fluid px-lg-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">

                    <div class="container-fluid mt-4" style="padding: inherit;">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <h2>
                                {{ trans('messages.confermaCancellazione') }} {{ \Carbon\Carbon::parse($prenotazione->arrivo)->format('d/m/Y') }} {{ trans('messages.al') }} {{ \Carbon\Carbon::parse($prenotazione->partenza)->format('d/m/Y') }}?
                                </h2>

                            </div>
                        </div>

                        <div id="inner">

                            <!-- Card con i dettagli della prenotazione, strutturata in due colonne -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-8"> <!-- Puoi adattare la larghezza se necessario -->
                                    <div class="card border-secondary">
                                        <div class="card-header text-center">
                                            {{ trans('messages.dettagli') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <!-- Colonna per intestazioni -->
                                                    <p><strong>{{ trans('messages.arrivo') }}:</strong></p>
                                                    <p><strong>{{ trans('messages.partenza') }}:</strong></p>
                                                    <p><strong>{{ trans('messages.numAdulti') }}:</strong></p>
                                                    <p><strong>{{ trans('messages.numBambini') }}:</strong></p>
                                                    <p><strong>{{ trans('messages.prezzo') }}:</strong></p>
                                                    <p><strong>Email:</strong></p>
                                                    <p><strong>{{ trans('messages.tel') }}:</strong></p>
                                                    <p><strong>{{ trans('messages.stato') }}:</strong></p>
                                                    <p><strong>{{ trans('messages.orario') }}:</strong></p>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <!-- Colonna per i dati -->
                                                    <p>{{ \Carbon\Carbon::parse($prenotazione->arrivo)->format('d/m/Y') }}</p>
                                                    <p>{{ \Carbon\Carbon::parse($prenotazione->partenza)->format('d/m/Y') }}</p>
                                                    <p>{{ $prenotazione->numAdulti }}</p>
                                                    <p>{{ $prenotazione->numBambini }}</p>
                                                    <p>€{{ $prenotazione->prezzoTotale }}</p>
                                                    <p>{{ $prenotazione->email }}</p>
                                                    <p>{{ $prenotazione->telefono }}</p>
                                                    <p>{{ $prenotazione->stato }}</p>
                                                    <p>{{ \Carbon\Carbon::parse($prenotazione->orarioArrivo)->format('H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card di conferma cancellazione -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-4 mt-md-0 card-conferma-eliminazione">
                                    <div class="card border-secondary card-custom-width">
                                        <div class="card-header text-center ">
                                            Conferma
                                        </div>
                                        <div class="card-body text-center">
                                            <p>
                                                {{ trans('messages.prenotazione') }} <strong>{{ trans('messages.cancellata') }}</strong>
                                            </p>
                                            <form name="prenotazione" method="post" action="{{ route('prenotazioniUtente.destroy', ['prenotazioniUtente' => $prenotazione->id]) }}" style="padding: 0.80em;">
                                                @method('DELETE')
                                                @csrf
                                                <label for="mySubmit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> {{ trans('button.elimina') }}</label>
                                                <input id="mySubmit" class="d-none" type="submit" value="Delete">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card per annullare la cancellazione -->
                                <div class="col-md-4 mt-md-0 card-conferma-eliminazione">
                                    <div class="card border-secondary card-custom-width">
                                        <div class="card-header text-center">
                                            Annulla
                                        </div>
                                        <div class="card-body text-center">
                                            <p>
                                                {{ trans('messages.prenotazione') }} <strong>{{ trans('messages.nonCancellata') }}</strong>
                                            </p>
                                            <a class="btn btn-secondary w-100" href="{{ route('prenotazioniUtente.index') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('button.annulla') }}</a>
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
