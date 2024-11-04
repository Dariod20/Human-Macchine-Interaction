@extends('layouts.master')

@section('titolo')
{{ trans('button.prenotazioni') }}
@endsection

@section('script')
<script src="{{ url('/') }}/js/paginationScript.js"></script>
@endsection

@section('active_prenotazioniUtente','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ trans('button.prenotazioni') }}</li>
@endsection

@section('corpo')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<script>
     $(document).ready(function(){
        var typingTimer; // Timer per ritardare l'azione
        var doneTypingInterval = 200; // Tempo di attesa dopo l'ultimo tasto premuto (in millisecondi)
        var currentPage = 1;

        $("#searchInput").on("keyup", function() {
            clearTimeout(typingTimer); // Cancella il timer precedente
            typingTimer = setTimeout(doneTyping, doneTypingInterval); // Imposta un nuovo timer
        });


        function doneTyping() {
            var value = $("#searchInput").val().toLowerCase();

            if (value !== "") {
                $("#paginationNav").hide();
                var foundAny = false; // Variabile per tenere traccia se troviamo risultati

                $("#bookTable tbody tr").each(function() {
                    var found = false;
                    $(this).find("td").slice(0, 2).each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    });
                    $(this).toggle(found);
                    if (found) {
                        foundAny = true; // Se troviamo almeno un risultato, aggiorniamo la variabile
                    }
                });
                // Mostra o nascondi il messaggio "nessun risultato"
                if (!foundAny) {
                    $("#noResultsMessage").show(); // Mostra il messaggio se non ci sono risultati
                } else {
                    $("#noResultsMessage").hide(); // Nascondi il messaggio se ci sono risultati
                }
            } else {
                // Se il campo di ricerca è vuoto, mostra la paginazione e ripristina tutte le righe
                $("#paginationNav").show();
                $("#bookTable tbody tr").show();
                $("#noResultsMessage").hide(); // Nascondi il messaggio
                currentPage = 1;
                showPage(currentPage);
            }
        }

        // Funzione per gestire l'annullamento della digitazione quando il tasto è ancora premuto
        $("#searchInput").on("keydown", function() {
            clearTimeout(typingTimer);
        });
    });
</script>

@php
    $lang = app()->getLocale();
    $dateFormat = $lang === 'it' ? 'd/m/Y' : 'Y/m/d'; // Imposta il formato della data in base alla lingua
@endphp

<section id="form-admin">
    <div class="container-fluid px-lg-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">


                <div class="container-fluid mb-3 pt-3 text-center">
                    <h1>
                        {{ trans('messages.prenIt') }}{{ session('loggedName') }}{{ trans('messages.prenEn') }}
                    </h1>
                </div>

                <div id="inner">
                    <div class="container-fluid px-lg-4">
                        <div class="row mb-3 pt-3 justify-content-center">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" placeholder="{{ trans('pagination.cercaData') }}">
                                    <span class="input-group-addon">
                                        <i class="bi bi-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

    <div class="col-md-4 d-flex justify-content-end align-items-center">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownRowsPerPage"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ trans('button.visualizzazione') }} &nbsp&nbsp
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownRowsPerPage">
                    <a class="dropdown-item" href="#" data-value="5">5 {{ trans('pagination.booking') }}</a>
                    <a class="dropdown-item" href="#" data-value="10">10 {{ trans('pagination.booking') }}</a>
                    <a class="dropdown-item" href="#" data-value="15">15 {{ trans('pagination.booking') }}</a>
                    <a class="dropdown-item" href="#" data-value="20">20 {{ trans('pagination.booking') }}</a>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation example" id="paginationNav">
        <ul class="pagination justify-content-center">
            <li class="page-item" id="previousPage"><a class="page-link" href="#"> {{ trans('pagination.previous') }} </a></li>
            <li class="page-item" id="nextPage"><a class="page-link" href="#"> {{ trans('pagination.next') }} </a></li>
        </ul>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="bookTable" class="table table-striped">
                    <colgroup>
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>{{ trans('messages.arrivo') }}</th>
                            <th>{{ trans('messages.partenza') }}</th>
                            <th>{{ trans('messages.prezzo') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prenotazioni as $prenotazione)
                            <tr>
                                <td>{{ $prenotazione->arrivo }}</td>
                                <td>{{ $prenotazione->partenza }}</td>
                                <td>€{{ $prenotazione->prezzoTotale }}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group">
                                        <a class="btn btn-secondary mb-1" href="{{ route('prenotazioniUtente.show', ['prenotazioniUtente' => $prenotazione->id]) }}">{{ trans('button.dettagli') }}</a>
                                        @if (Carbon\Carbon::parse($prenotazione->arrivo)->isFuture() || Carbon\Carbon::parse($prenotazione->arrivo)->isToday())
                                            <a class="btn btn-danger" href="{{ route('prenotazioniUtente.destroy.confirm', ['id' => $prenotazione->id]) }}"><i class="bi bi-trash"></i> {{ trans('button.elimina') }}</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
