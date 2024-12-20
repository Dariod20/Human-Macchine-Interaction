@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title')
@if(isset($prenotazione->id))
    Modifica prenotazione
@elseif(isset($arrivo))
    {{ trans('messages.conferma') }}
@else
    Aggiungi prenotazione
@endif
@endsection

@section('active_prenotazioniAdmin', 'active')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
@if(isset($prenotazione->id))
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prenotazioniAdmin.index') }}">Prenotazioni Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifica prenotazione</li>
@elseif(isset($arrivo))
    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.conferma') }}   </li>
@else
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prenotazioniAdmin.index') }}">Prenotazioni Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Aggiungi prenotazione</li>
@endif
@endsection

@section('corpo')
<script>
    $(document).ready(function(){
        $('#arrivo, #partenza').change(function() {
        var arrivo = $('#arrivo').val();
        var partenza = $('#partenza').val();

        if (arrivo && partenza) {
            $.ajax({
                type: 'GET',
                url: '{{ route("ajaxCalcolaPrezzoTotale") }}',
                data: {
                    arrivo: arrivo,
                    partenza: partenza
                },
                success: function(data) {
                    $('#prezzoTotale').val(data.prezzoTotale);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }
        });
        $("form").submit(function(event) {
                // Definire le espressioni regolari per verificare che i campi non contengano cifre
            var regex = /^[a-zA-Z\s]+$/
            // Ottenere i valori dei campi firstName e lastName
            var firstName = $("input[name='nome']").val();
            var lastName = $("input[name='cognome']").val();
            var error = false;
            // Verifica se il campo "lastName" è vuoto
            if (lastName.trim() === "") {
                $("#invalid-lastName").text("Il cognome è obbligatorio.");
                error = true;
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='cognome']").focus();
            } else if (!regex.test(lastName)) {
                error = true;
                $("#invalid-lastName").text("Il cognome non deve contenere cifre.");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='cognome']").focus();
            } else {
                $("#invalid-lastName").text("");
            }

            // Verifica se il campo "firstName" è vuoto
            if (firstName.trim() === "") {
                error = true;
                $("#invalid-firstName").text("Il nome è obbligatorio.");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='nome']").focus();
            } else if (!regex.test(firstName)) {
                error = true;
                $("#invalid-firstName").text("Il nome non deve contenere cifre.");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='nome']").focus();
            } else {
                $("#invalid-firstName").text("");
            }

            // Verifica il numero di telefono
            var regexPhone = /^[0-9]+$/;  // Espressione regolare per verificare che il telefono contenga solo cifre
            var telefono = $("input[name='telefono']").val();
            if (telefono.trim() === "") {
                error = true;
                $("#invalid-telefono").text("Il numero di telefono è obbligatorio.");
                event.preventDefault(); // Impedisce l'invio del modulo
                $("input[name='telefono']").focus();
            } else if (!regexPhone.test(telefono)) {
                $("#invalid-telefono").text("Il numero di telefono deve contenere solo cifre.");
                error = true;
                $("input[name='telefono']").focus();
                event.preventDefault();
            } else {
                $("#invalid-telefono").text("");
            }

            // Verifica dell'email
            var regexEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;  // Espressione regolare per verificare che l'email sia valida
            var email = $("input[name='email']").val();
            if (email.trim() === "") {
                $("#invalid-email").text("L'email è obbligatoria.");
                error = true;
                $("input[name='email']").focus();
                event.preventDefault();
            } else if(!regexEmail.test(email)) {
                $("#invalid-email").text("Inserisci un'email valida.");
                error = true;
                $("input[name='email']").focus();
                event.preventDefault();
            } else {
                $("#invalid-email").text("");
            }

            var arrivo = $("input[name='arrivo']").val();
            var partenza = $("input[name='partenza']").val();
                 // Verifica se i campi "arrivo" e "partenza" sono vuoti
            if (arrivo.trim() === "") {
                error = true;
                $("#invalid-arrivo").text("La data di arrivo è obbligatoria.");
                event.preventDefault();
                $("#arrivo").focus();
            } else {
                $("#invalid-arrivo").text("");
            }

            if (partenza.trim() === "") {
                error = true;
                $("#invalid-partenza").text("La data di partenza è obbligatoria.");
                event.preventDefault();
                $("#partenza").focus();
            } else {
                $("#invalid-partenza").text("");
            }

            // Verifica che la data di arrivo non coincida con la data di partenza
            if (arrivo.trim() !== "" && partenza.trim() !== "" && arrivo === partenza) {
                error = true;
                $("#invalid-arrivo").text("La data di arrivo e partenza non possono coincidere.");
                $("#invalid-partenza").text("La data di arrivo e partenza non possono coincidere.");
                event.preventDefault();
                $("#arrivo").focus();
            } else if(arrivo.trim() !== "" && partenza.trim() !== "" && arrivo > partenza) {
                error = true;
                $("#invalid-arrivo").text("La data di partenza non può precedere la data di arrivo.");
                $("#invalid-partenza").text("La data di partenza non può precedere la data di arrivo.");
                event.preventDefault();
                $("#arrivo").focus();
            } else {
                $("#invalid-arrivo").text("");
                $("#invalid-partenza").text("");
            }

            if(!error) {
                var prenotazioneId = "{{ isset($prenotazione->id) ? $prenotazione->id : '' }}";

                event.preventDefault(); // Impedisce l'invio del modulo
                $.ajax({
                    type: 'GET',
                    url: '{{ route("ajaxCheckPrenotazione") }}',
                    data: {
                        arrivo: arrivo.trim(),
                        partenza: partenza.trim(),
                        prenotazioneId: prenotazioneId // Invia l'ID della prenotazione se presente
                    },
                    success: function (data) {
                        if (data.found) {
                            error = true;
                            var occupiedDatesText = "Alcune delle date inserite sono già occupate. Ci sono già prenotazioni: ";
                            data.occupiedDates.forEach(function (date) {
                                occupiedDatesText += "dal " + date.arrivo + " al " + date.partenza + ", ";
                            });
                            occupiedDatesText = occupiedDatesText.slice(0, -2); // Remove the last comma and space
                            $("#invalid-arrivo").text(occupiedDatesText);
                            $("#invalid-partenza").text(occupiedDatesText);
                            $("#arrivo").focus();
                        } else {

                            // Chiamata AJAX per verificare le tariffe disponibili
                            $.ajax({
                                type: 'GET',
                                url: '{{ route("ajaxCheckTariffePrenotazione") }}',
                                data: {
                                    arrivo: arrivo.trim(),
                                    partenza: partenza.trim(),
                                    context: "{{ isset($arrivo) ? 'conferma' : 'altro' }}"
                                },
                                success: function (response) {
                                    if (!response.available) {
                                        error = true;
                                        var message = (response.context === 'conferma') ?
                                            "La casa vacanze è chiusa in queste date, controllare il calendario" :
                                            response.message;
                                        $("#invalid-arrivo").text(message);
                                        $("#invalid-partenza").text(message);
                                        $("#arrivo").focus();
                                    } else {
                                        $("form")[0].submit();
                                    }
                                }
                            });
                        }
                    }
                });

            }







        });
    });


    </script>

    <div class="container-fluid px-lg-4 mt-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($prenotazione->id))
                    <h1>Modifica prenotazione:</h1>
                @elseif(isset($arrivo))
                    <h1>{{ trans('messages.conferma') }}</h1>
                @else
                    <h1>Aggiungi prenotazione:</h1>
                @endif
                @if(isset($prenotazione->id))
                    <form class="form-horizontal" name="prenotazioniAdmin" method="post" action="{{ route('prenotazioniAdmin.update', ['prenotazioniAdmin' => $prenotazione->id]) }}">
                    <!--<input type="hidden" name="_method" value="PUT">-->
                    @method('PUT')
                @elseif(isset($arrivo))
                    <form class="form-horizontal" name="prenotazioniUtente" method="post" action="{{ route('prenotazioniUtente.store') }}">
                @else
                    <form class="form-horizontal" name="prenotazioniAdmin" method="post" action="{{ route('prenotazioniAdmin.store') }}">
                @endif
                @csrf



                <div class="mb-3">
                    <label for="arrivo" class="form-label">{{ trans('messages.arrivo') }}</label>
                    @if(isset($prenotazione->id))
                        <input class="form-control" type="date" id="arrivo" name="arrivo" value="{{ $prenotazione->arrivo }}"/>
                    @elseif(isset($arrivo))
                        <input class="form-control" type="date" id="arrivo" name="arrivo" value="{{ $arrivo }}"/>
                    @else
                        <input class="form-control" type="date" id="arrivo" name="arrivo"/>
                    @endif
                    <span class="invalid-input" id="invalid-arrivo"></span>
                </div>
                <div class="mb-3">
                    <label for="arrivo" class="form-label">{{ trans('messages.partenza') }}</label>
                    @if(isset($prenotazione->id))
                        <input class="form-control" type="date" id="partenza" name="partenza" value="{{ $prenotazione->partenza }}"/>
                    @else
                        <input class="form-control" type="date" id="partenza" name="partenza"/>
                    @endif
                    <span class="invalid-input" id="invalid-partenza"></span>
                </div>
                <div class="mb-3">
                    <label for="numAdulti" class="form-label">{{ trans('messages.numAdulti') }}</label>
                    @if(isset($prenotazione->id))
                        <select class="form-select shadow-none" name="numAdulti" value="{{ $prenotazione->numAdulti }}">
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                            <option value="4">Quattro</option>
                            <option value="5">Cinque</option>
                        </select>
                    @else
                    <select class="form-select shadow-none" name="numAdulti">
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                            <option value="4">Quattro</option>
                            <option value="5">Cinque</option>
                        </select>
                    @endif
                </div>
                <div class="mb-3">
                <label for="numBambini" class="form-label">{{ trans('messages.numBambini') }}</label>
                    @if(isset($prenotazione->id))
                        <select class="form-select shadow-none" name="numBambini" value="{{ $prenotazione->numBambini }}">
                            <option value="0">Zero</option>
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                        </select>
                    @else
                        <select class="form-select shadow-none" name="numBambini">
                            <option value="0">Zero</option>
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                        </select>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="prezzoTotale" class="form-label">{{ trans('messages.prezzo') }}</label>
                    <input type="text" class="form-control" id="prezzoTotale" name="prezzoTotale" readonly>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">{{ trans('messages.nome') }}</label>
                    @if(isset($prenotazione->id))
                        <input class="form-control" type="text" id="nome" name="nome" value="{{ $prenotazione->nome }}"/>
                        <span class="invalid-input" id="invalid-firstName"></span>
                    @else
                        <input class="form-control" type="text" id="nome" name="nome"/>
                        <span class="invalid-input" id="invalid-firstName"></span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="cognome" class="form-label">{{ trans('messages.cognome') }}</label>
                    @if(isset($prenotazione->id))
                        <input class="form-control" type="text" id="cognome" name="cognome" value="{{ $prenotazione->cognome }}"/>
                        <span class="invalid-input" id="invalid-lastName"></span>
                    @else
                        <input class="form-control" type="text" id="cognome" name="cognome"/>
                        <span class="invalid-input" id="invalid-lastName"></span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    @if(isset($prenotazione->id))
                        <input class="form-control" type="text" name="email" value="{{ $prenotazione->email }}"/>
                        <span class="invalid-input" id="invalid-email"></span>
                    @else
                        <input class="form-control" type="text" name="email"/>
                        <span class="invalid-input" id="invalid-email"></span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="stato" class="form-label">{{ trans('messages.stato') }}</label>
                    @if(isset($prenotazione->id))
                        <select class="form-select shadow-none" name="stato" value="{{ $prenotazione->numBambini }}">
                            <option value="italia">Italia</option>
                            <option value="francia">Francia</option>
                            <option value="germania">Germania</option>
                                    <!-- Aggiungi altre opzioni secondo necessità -->
                        </select>
                    @else
                        <select class="form-control" id="stato" name="stato">
                            <option value="italia">Italia</option>
                            <option value="francia">Francia</option>
                            <option value="germania">Germania</option>
                                    <!-- Aggiungi altre opzioni secondo necessità -->
                        </select>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">{{ trans('messages.tel') }}</label>
                    @if(isset($prenotazione->id))
                        <input class="form-control" type="tel" name="telefono" value="{{ $prenotazione->telefono }}"/>
                        <span class="invalid-input" id="invalid-telefono"></span>
                    @else
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        <span class="invalid-input" id="invalid-telefono"></span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="orarioArrivo" class="form-label">{{ trans('messages.orario') }}</label>
                    @if(isset($prenotazione->id))
                        <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo" required value="{{ $prenotazione->orarioArrivo }}"/>
                    @else
                        <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo" required>
                    @endif
                </div>

                <div class="form-group row mb-3">
                    <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> {{ trans('messages.salva') }}</label>
                    <input id="mySubmit" class="d-none" type="submit" value="Save">
                </div>
                <div class="form-group row mb-3">
                        <a class="btn btn-secondary w-100" href="{{ route('prenotazioniAdmin.index') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('messages.annulla') }}</a>
                </div>

            </form>
            </div>
        </div>
    </div>






@endsection

