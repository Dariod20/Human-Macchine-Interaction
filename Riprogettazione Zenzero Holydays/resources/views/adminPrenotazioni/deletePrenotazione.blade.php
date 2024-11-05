@extends('layouts.master') 

@section('titolo')
    Elimina prenotazione
@endsection

@section('active_prenotazioniAdmin','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prenotazioniAdmin.index') }}">Prenotazioni Admin</a></li>
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
                                    Stai per cancellare la prenotazione di "{{ $prenotazione->nome }} {{ $prenotazione->cognome }}"
                                </h2>
                            </div>
                        </div>

                        <div id="inner">
                            <!-- Card con i dettagli della prenotazione, strutturata in due colonne -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-8"> <!-- Puoi adattare la larghezza se necessario -->
                                    <div class="card border-secondary">
                                        <div class="card-header text-center">
                                            Dettagli della Prenotazione
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <!-- Colonna per intestazioni -->
                                                    <p><strong>Arrivo:</strong></p>
                                                    <p><strong>Partenza:</strong></p>
                                                    <p><strong>Numero Adulti:</strong></p>
                                                    <p><strong>Numero Bambini:</strong></p>
                                                    <p><strong>Prezzo Totale:</strong></p>
                                                    <p><strong>Email:</strong></p>
                                                    <p><strong>Telefono:</strong></p>
                                                    <p><strong>Stato:</strong></p>
                                                    <p><strong>Orario Arrivo:</strong></p>
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
                                            <form name="prenotazione" method="post" action="{{ route('prenotazioniAdmin.destroy', ['prenotazioniAdmin' => $prenotazione->id]) }}" style="padding: 0.80em;">
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
                                            <a class="btn btn-secondary w-100" href="{{ route('prenotazioniAdmin.index') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('button.annulla') }}</a>
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
