@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title')
@if(isset($tariffa->id))
    Modifica tariffa
@elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo')
    Modifica gruppo di tariffe
@else
    Aggiungi gruppo di tariffe
@endif
@endsection

@section('active_tariffe', 'active')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('tariffeAdmin.index') }}">Tariffe</a></li>
@if(isset($tariffa->id))
    <li class="breadcrumb-item active" aria-current="page">Modifica tariffa</li>
@elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo')
    <li class="breadcrumb-item active" aria-current="page">Modifica gruppo di tariffe</li>
@else
    <li class="breadcrumb-item active" aria-current="page">Aggiungi gruppo di tariffe</li>
@endif
@endsection

@section('corpo')
<script>
    $(document).ready(function(){
        $("form").submit(function(event) {
            var error = false;
            var giorno = $("input[name='giorno']").val();
            var prezzo = $("input[name='prezzo']").val();
            var giorno_fino = $("input[name='giornoFino']").val();
            var isEditGruppo = $("input[name='isEditGruppo']").val() === "true"; // Nuovo campo
            var isAddGruppo = $("input[name='isAddGruppo']").val() === "true"; // Nuovo campo

                 
            if (giorno.trim() === "") {
                error = true;
                $("#invalid-giorno").text("Il giorno è obbligatorio.");
                event.preventDefault();
                $("#giorno").focus();
            } else {
                $("#invalid-giorno").text("");
            }

            if (isEditGruppo || isAddGruppo){
                if (giorno_fino.trim() === "") {
                    error = true;
                    $("#invalid-giorno_fino").text("Il giorno è obbligatorio.");
                    event.preventDefault();
                    $("#giorno_fino").focus();
                } else if(giorno.trim() !== "" && giorno_fino.trim() !== "" && giorno > giorno_fino) {
                    error = true;
                    document.getElementById('invalid-giorno').textContent = "{{ trans('errors.giornoErr') }}";
                    document.getElementById('invalid-giorno_fino').textContent = "{{ trans('errors.giornoFinoErr') }}";

                    $("#invalid-giorno").text("Il giorno selezionato deve essere uguale o precedente alla data 'Fino al giorno'. Per favore, seleziona una data valida.");
                    event.preventDefault();
                    $("#giorno").focus();
                }else{
                    $("#invalid-giorno_fino").text("");
                }
            }
            

            if (prezzo.trim() === "") {
                error = true;
                $("#invalid-prezzo").text("Il prezzo è obbligatorio.");
                event.preventDefault();
                $("#prezzo").focus();
            }// Controllo che il prezzo non sia negativo
            else if (parseFloat(prezzo) < 0) {
                error = true;
                $("#invalid-prezzo").text("Il prezzo non può essere negativo.");
                event.preventDefault();
                $("#prezzo").focus();
            } else {
                $("#invalid-prezzo").text("");
            }
            if(!error)
            {
                
                var metodoHttp = $('input[name="_method"]').val();
                 // la pagina è state caricata per creare una nuova tariffa
                if (metodoHttp === undefined && !isEditGruppo ){
                    event.preventDefault(); // Impedisce l'invio del modulo
                    $.ajax({

                    type: 'GET',

                    url: '{{ route("ajaxCheckTariffa") }}',

                    data: { giorno: giorno.trim(),
                            giornoFino: giorno_fino.trim()
                    },

                    success: function (data) {
                        if (data.found) {
                            error = true;
                            // Mostra il messaggio con la lista di tariffe trovate
                            var message = "Tariffe già presenti per i seguenti giorni:\n";
                            data.tariffe.forEach(function (tariffa) {
                                message += tariffa.giorno + ": " + tariffa.prezzo + "€;  \n";
                            });
                            $("#invalid-giorno").text(message);
                        } else {
                            $("form")[0].submit();
                        }
                    }
                }); 
                }

                if (isEditGruppo) {
                    event.preventDefault(); // Blocca l'invio del modulo
                    
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("tariffeAdmin.ajaxCheckTariffePrenotazioni") }}',
                        data: { giorno: giorno.trim(), giornoFino: giorno_fino.trim() },
                        success: function (data) {
                            if (data.hasBookings) {
                                $("#invalid-giorno").text("Esistono prenotazioni associate alle tariffe nei seguenti giorni: " + data.bookedDays.join(', '));
                            } else {
                                $.ajax({
                                type: 'GET',
                                url: '{{ route("ajaxCheckTariffePrenotazione") }}',
                                data: {
                                    giorno: giorno.trim(),
                                    giorno_fino: giorno_fino.trim(),
                                    context: 'altro' 
                                },
                                success: function (response) {
                                    
                                    if (!response.available) {
                                        error = true;
                                        $("#invalid-giorno").text(response.message);
                                        $("#invalid-giorno_fino").text(response.message);
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
                
                
            }





                
            
        });
    });
    

    </script>

    
    <div class="container-fluid px-lg-4 mt-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($tariffa->id))
                    <h1>Modifica tariffa:</h1>
                @elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo')
                    <h1>Modifica gruppo di tariffe</h1>
                @else
                    <h1>Aggiungi gruppo di tariffe:</h1>
                @endif
                @if(isset($tariffa->id))
                    <form class="form-horizontal" name="tariffeAdmin" method="post" action="{{ route('tariffeAdmin.update', ['tariffeAdmin' => $tariffa->id]) }}">
                    @method('PUT')
                @elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo')
                    <form class="form-horizontal" name="tariffeAdmin" method="post" action="{{ route('tariffeAdmin.updateGruppo') }}" >
                    @csrf
                @else
                    <form class="form-horizontal" name="tariffeAdmin" method="post" action="{{ route('tariffeAdmin.store') }}">
                @endif
                @csrf

                <input type="hidden" name="isEditGruppo" value="{{ Route::currentRouteName() === 'tariffeAdmin.editGruppo' ? 'true' : 'false' }}">
                <input type="hidden" name="isAddGruppo" value="{{ Route::currentRouteName() === 'tariffeAdmin.create' ? 'true' : 'false' }}">


                <div class="mb-4">
                    @if((Route::currentRouteName() === 'tariffeAdmin.editGruppo')||(Route::currentRouteName() === 'tariffeAdmin.create'))
                        <label for="giorno" class="form-label">Dal giorno</label>
                    @else
                        <label for="giorno" class="form-label">Giorno</label>
                    @endif
                    @if(isset($tariffa->id))
                        <input class="form-control" type="date" id="giorno" name="giorno" value="{{ $tariffa->giorno }}"/>
                    @else
                        <input class="form-control" type="date" id="giorno" name="giorno"/>
                    @endif
                    <span class="invalid-input" id="invalid-giorno"></span>
                </div>
                @if((Route::currentRouteName() === 'tariffeAdmin.editGruppo')||(Route::currentRouteName() === 'tariffeAdmin.create'))
                    <div class="mb-4" id="giorno_fino_container">
                        <label for="giorno_fino" class="form-label">Fino al giorno</label>
                        <input class="form-control" type="date" id="giorno_fino" name="giornoFino" />
                        <span class="invalid-input" id="invalid-giorno_fino"></span>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="prezzo" class="form-label">Prezzo</label>
                    @if(isset($tariffa->id))
                        <input class="form-control" type="number" id="prezzo" name="prezzo" value="{{ $tariffa->prezzo }}"/>
                    @else
                        <input class="form-control" type="number" id="prezzo" name="prezzo"/>
                    @endif
                    <span class="invalid-input" id="invalid-prezzo"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Salva</label>
                    <input id="mySubmit" class="d-none" type="submit" value="Save">
                </div>
                <div class="form-group mb-3">
                    <a class="btn btn-danger w-100" href="{{ route('tariffeAdmin.index') }}"><i class="bi bi-box-arrow-left"></i> Annulla</a>
                </div>

            </form>
            </div>
        </div>
    </div>



    
       
    
@endsection

   