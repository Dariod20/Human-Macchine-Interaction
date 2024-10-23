@extends('layouts.master')

@section('titolo')
{{ trans('messages.conferma') }}
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('active_prenota', 'active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('calendario') }}">{{ trans(key: 'button.book') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ trans('messages.conferma') }}</li>
@endsection



@section('corpo')

<script>
  
  function populate(s1, s2) {
      var s1 = document.getElementById(s1);
      var s2 = document.getElementById(s2);
      s2.innerHTML = "";
      if (s1.value == "1") {
        s2.disabled = false;
        var optionArray = ["0|0", "1|1", "2|2", "3|3", "4|4", "5|5"];
      } else if (s1.value == "2") {
        s2.disabled = false;
        var optionArray = ["0|0", "1|1", "2|2", "3|3", "4|4"];
      } else if (s1.value == "3") {
        s2.disabled = false;
        var optionArray = ["0|0", "1|1", "2|2", "3|3"];
      } else if (s1.value == "4") {
        s2.disabled = false;
        var optionArray = ["0|0", "1|1", "2|2"];
      } else if (s1.value == "5") {
        s2.disabled = false;
        var optionArray = ["0|0", "1|1"];
      } else if (s1.value == "6") {
        s2.disabled = true;
        s2.value =0;
        var optionArray = ["0|0"];
      }
      for (var option in optionArray) {
        var pair = optionArray[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        s2.options.add(newOption);
      }
    }

    window.onload = function () {
      populate('numAdulti', 'numBambini');  // Popola la select per i bambini all'apertura
    };
  
  $(document).ready(function(){
    const nextButton = document.querySelector('.btn-next');
    const prevButton = document.querySelector('.btn-prev');
    const steps = document.querySelectorAll('.step');
    const form_step = document.querySelectorAll('.form-step');
    let active = 1;

    // Date arrivano in formato DD-MM-YYYY
    $('#arrivo').val('{{ $arrivo }}'); 
    $('#partenza').val('{{ $arrivoDopo }}');
    // Converto in formato YYYY-MM-DD per il database
    var arrivo = moment($('#arrivo').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
    var partenza = moment($('#partenza').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
    // Imposto i valori formattati nel campo input
    $('#arrivo').val(arrivo); 
    $('#partenza').val(partenza); 

    var lang = '{{ app()->getLocale() }}'
    var minDate = moment().startOf('day'); // Imposta a mezzanotte di oggi

    $(function () {
    // Configura il daterangepicker
    $('input[name="daterange"]').daterangepicker({
      opens: 'right',
      autoApply: true,
      startDate: '{{ $arrivo }}',
      endDate: '{{ $arrivoDopo }}',
      minDate: minDate, // Imposta la data minima
      locale: {
        format: 'DD/MM/YYYY', // Imposta il formato corretto
        firstDay: lang === 'it' ? 1 : 0, // Setta il lunedì come primo giorno per 'it', domenica per 'en'
        daysOfWeek: lang === 'it' ? [ "Dom","Lun", "Mar", "Mer", "Gio", "Ven", "Sab"] : ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        monthNames: lang === 'it' ? [
          "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", 
          "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"
        ] : [
          "January", "February", "March", "April", "May", "June", 
          "July", "August", "September", "October", "November", "December"
        ]
      }
      
    }, function (start, end, label) {
      $('#arrivo').val(start.format('YYYY-MM-DD'));
      $('#partenza').val(end.format('YYYY-MM-DD'));
    });
  });

   
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
                    $('#prezzoTotaleNumero').text(data.prezzoTotale);
                },
                error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  // Handle error
                }
            });
        }
    });

    nextButton.addEventListener('click', () => {
        if (active === 1) {
            if (validateStep1()) {
                checkAvailabilityAndProceed(); // Controlla la disponibilità tramite AJAX prima di avanzare
            }
        } else if (active === 2) {
            
          active++;
          if (active > steps.length) {
            active = steps.length;
          }
          updateProgress();
            
        }else if (active === 3) {
            if (validateStep3()) {
                active++;
                if (active > steps.length) {
                    active = steps.length;
                }
                updateProgress();
            }
        }
    });

    prevButton.addEventListener('click', () => {
        active--;
        if (active < 1) {
            active = 1;
        }
        updateProgress();
    });

    const updateProgress = () => {
        steps.forEach((step, i) => {
            if (i == active - 1) {
                step.classList.add('active');
                form_step[i].classList.add('active');
            } else {
                step.classList.remove('active');
                form_step[i].classList.remove('active');
            }
        });

        if (active === 1) {
            prevButton.disabled = true;
        } else if (active === steps.length) {
            nextButton.disabled = true;
            showSummary();
        } else {
            prevButton.disabled = false;
            nextButton.disabled = false;
        }
    };

    function decodeHtmlEntities(str) {
      var txt = document.createElement("textarea");
      txt.innerHTML = str;
      return txt.value;
    }

    // Validazione del primo step
    function validateStep1() {
        var arrivo = document.getElementById('arrivo').value;
        var partenza = document.getElementById('partenza').value;
        var numAdulti = document.getElementById('numAdulti').value;
        var numBambini = document.getElementById('numBambini').value;
        var orarioArrivo = document.getElementById('orarioArrivo').value;
        var error = false;

        if (arrivo.trim() === "") {
            document.getElementById('invalid-arrivo').textContent = "{{ trans('errors.arrivo') }}";
            error = true;
            $("#daterange").focus();
        } else {
            document.getElementById('invalid-arrivo').textContent = "";
        }

        if (partenza.trim() === "") {
            document.getElementById('invalid-arrivo').textContent = "{{ trans('errors.partenza') }}";
            error = true;
            $("#daterange").focus();
        } else {
            document.getElementById('invalid-arrivo').textContent = "";
        }

        if (arrivo && partenza && arrivo >= partenza) {
            document.getElementById('invalid-arrivo').textContent = "{{ trans('errors.arrivoErr') }}";
            $("#daterange").focus();
            error = true;
        }

        if (orarioArrivo.trim() === "") {
            var errorMsg = "{{ trans('errors.orario') }}"; // Usa la sintassi sicura di Laravel
            document.getElementById('invalid-orarioArrivo').textContent = decodeHtmlEntities(errorMsg); // Decodifica l'entità HTML in JavaScript
            error = true;
            $("#orarioArrivo").focus();
        } else {
            document.getElementById('invalid-orarioArrivo').textContent = "";
        }

        return !error; // Ritorna true se non ci sono errori
    }
    
    // Validazione del secondo step
    function validateStep3() {
        var firstName = document.getElementById('nome').value;
        var lastName = document.getElementById('cognome').value;
        var telefono = document.getElementById('telefono').value;
        var email = document.getElementById('email').value;
        var stato = document.getElementById('stato').value;
        var regexName = /^[a-zA-Z\s]+$/;
        var regexPhone = /^[0-9]+$/;
        var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var error = false;

        if (firstName.trim() === "") {
            document.getElementById('invalid-firstName').textContent = "{{ trans('errors.nome') }}";
            error = true;
            $("input[name='nome']").focus();
        } else if (!regexName.test(firstName)) {
            document.getElementById('invalid-firstName').textContent = "{{ trans('errors.nomeErr') }}";
            error = true;
            $("input[name='nome']").focus();
        } else {
            document.getElementById('invalid-firstName').textContent = "";
        }

        if (lastName.trim() === "") {
            document.getElementById('invalid-lastName').textContent = "{{ trans('errors.cognome') }}";
            error = true;
            $("input[name='cognome']").focus();
        } else if (!regexName.test(lastName)) {
            document.getElementById('invalid-lastName').textContent = "{{ trans('errors.cognomeErr') }}";
            error = true;
            $("input[name='cognome']").focus();
        } else {
            document.getElementById('invalid-lastName').textContent = "";
        }

        if (telefono.trim() === "") {
            document.getElementById('invalid-telefono').textContent = "{{ trans('errors.tel') }}";
            error = true;
            $("input[name='telefono']").focus();
        } else if (!regexPhone.test(telefono)) {
            document.getElementById('invalid-telefono').textContent = "{{ trans('errors.telErr') }}";
            error = true;
            $("input[name='telefono']").focus();
        } else {
            document.getElementById('invalid-telefono').textContent = "";
        }

        if (email.trim() === "") {
          var errorMsg = "{{ trans('errors.email') }}"; // Usa la sintassi sicura di Laravel
          document.getElementById('invalid-email').textContent = decodeHtmlEntities(errorMsg); // Decodifica l'entità HTML in JavaScript
          error = true;
          $("input[name='email']").focus();
        } else if (!regexEmail.test(email)) {
            document.getElementById('invalid-email').textContent = "{{ trans('errors.emailErr') }}";
            error = true;
            $("input[name='email']").focus();
        } else {
            document.getElementById('invalid-email').textContent = "";
        }

        if (stato.trim() === "") {
            document.getElementById('invalid-stato').textContent = "{{ trans('errors.stato') }}";
            error = true;
            $("input[name='email']").focus();
        } else {
            document.getElementById('invalid-stato').textContent = "";
        }

        return !error; // Ritorna true se non ci sono errori
    }

    // Chiamata AJAX per verificare la disponibilità delle date e il calcolo del prezzo
    function checkAvailabilityAndProceed() {
        var arrivo = $('#arrivo').val().trim();
        var partenza = $('#partenza').val().trim();
        var prenotazioneId = "{{ isset($prenotazione->id) ? $prenotazione->id : '' }}";

        $.ajax({
            type: 'GET',
            url: '{{ route("ajaxCheckPrenotazione") }}',
            data: {
                arrivo: arrivo,
                partenza: partenza,
                prenotazioneId: prenotazioneId
            },
            success: function (data) {
                if (data.found) {
                    var occupiedDatesText = "{{ trans('errors.dateOcc') }}";
                    data.occupiedDates.forEach(function (date) {
                        occupiedDatesText += "{{ trans('errors.dateDal') }} " + date.arrivo + " {{ trans('errors.dateAl') }} " + date.partenza + ", ";
                    });
                    occupiedDatesText = occupiedDatesText.slice(0, -2); // Rimuovi l'ultima virgola
                    $("#invalid-arrivo").text(occupiedDatesText);
                    $("#daterange").focus();
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
                          "{{ trans('errors.dateChiuse') }}" :
                          response.message;
                        $("#invalid-arrivo").text(message);
                        $("#daterange").focus();
                      } else {
                        // Se tutto è valido, avanza al prossimo step
                        active++;
                        if (active > steps.length) {
                          active = steps.length;
                        }
                        updateProgress();
                      }
                    },
                    error: function (xhr, status, error) {
                      console.error(xhr.responseText);
                    }
                    });
                }
            }
        });
    }

    // Funzione per mostrare il riepilogo finale
    const showSummary = () => {
        const arrivoDaFormattare = document.getElementById('arrivo').value;
        const arrivo = moment(arrivoDaFormattare, 'YYYY-MM-DD').format('DD-MM-YYYY');
        const partenzaDaFormattare = document.getElementById('partenza').value;
        const partenza = moment(partenzaDaFormattare, 'YYYY-MM-DD').format('DD-MM-YYYY');
        const numAdulti = document.getElementById('numAdulti').value;
        const numBambini = document.getElementById('numBambini').value;
        const orarioArrivo = document.getElementById('orarioArrivo').value;
        const nome = document.getElementById('nome').value;
        const cognome = document.getElementById('cognome').value;
        const email = document.getElementById('email').value;
        const stato = document.getElementById('stato').value;
        const telefono = document.getElementById('telefono').value;
        const prezzo=document.getElementById('prezzoTotaleNumero').innerText;

        document.getElementById('riepilogo-soggiorno').innerHTML = `
          <strong>{{ trans('messages.arrivo') }}:</strong> ${arrivo}<br>
          <strong>{{ trans('messages.partenza') }}:</strong> ${partenza}<br>
          <strong>{{ trans('messages.orario') }}:</strong> ${orarioArrivo}
      `;

      document.getElementById('riepilogo-ospiti').innerHTML = `
          <strong>{{ trans('messages.numAdulti') }}:</strong> ${numAdulti}<br>
          <strong>{{ trans('messages.numBambini') }}:</strong> ${numBambini}
      `;

      document.getElementById('riepilogo-personali').innerHTML = `
          <strong>{{ trans('messages.nome') }}:</strong> ${nome} <strong>{{ trans('messages.cognome') }}:</strong> ${cognome}<br>
          <strong>{{ trans('messages.email') }}:</strong> ${email}<br>
          <strong>{{ trans('messages.tel') }}:</strong> ${telefono}<br>
          <strong>{{ trans('messages.stato') }}:</strong> ${stato}<br>`;
          

          document.getElementById('riepilogo-prezzo').innerHTML = `
          <strong>€${prezzo}</strong>`;
      }; 
            
});
</script>
  
<section id="formPrenota" class="px-lg-4">
    <div class="container" id="container-w">
        <div class="form-box">
          <div class="progress">
            <ul class="progress-steps">
              <li class="step active">
                <span>1</span>
                <p>{{ trans('messages.datiPrenotazione') }}</p>
              </li>
              <li class="step">
                <span>2</span>
                <p>{{ trans('messages.numOspiti') }}</p>
              </li>
              <li class="step">
                <span>3</span>
                <p>{{ trans('messages.datiPersonali') }}</p>
              </li>
              <li class="step">
                <span>4</span>
                <p>{{ trans('messages.riepilogo') }}</p>
              </li>
            </ul>
          </div>
          <form name="prenotazioniUtente" method="post" action="{{ route('prenotazioniUtente.store') }}">
            @csrf
            <div class="form-one form-step active">
              <h2>{{ trans('messages.datiPrenotazione') }}</h2>
              <div class="mb-3">
                <label for="daterange" class="form-label">{{ trans('messages.dateRange') }}</label>
                <input class="form-control" type="text" id="daterange" name="daterange" />
                <span class="invalid-input" id="invalid-arrivo"></span>
              </div>
              <!-- Campi nascosti per inviare arrivo e partenza -->
              <input type="hidden" id="arrivo" name="arrivo" value="{{ $arrivo }}">
              <input type="hidden" id="partenza" name="partenza">
              <div class="mb-3">
                <label for="orarioArrivo" class="form-label">{{ trans('messages.orario') }}</label>
                <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo">
                <div class="form-text"style="max-width: 400px;">
                  {{ trans('messages.infoOrario') }}
                </div>
                <span class="invalid-input" id="invalid-orarioArrivo"></span>
              </div>
              <div class="form-group" style="background-color: var(--main-color); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <label>{{ trans('messages.prezzo') }}:</label>
                <div id="prezzoTotale" class="prezzo-output">€<span id="prezzoTotaleNumero">0.00</span></div>
              </div>
            </div>
            <div class="form-two form-step">
              <h2>{{ trans('messages.numOspiti') }}</h2>
              <div class="mb-3">
                <label for="numAdulti" class="form-label">{{ trans('messages.numAdulti') }}</label>
                <select class="form-select shadow-none" id="numAdulti" name="numAdulti" onchange="populate(this.id,'numBambini')">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
                <div class="form-text" style="max-width: 300px;">
                  {{ trans('messages.infoLetti') }}
                </div>
              </div>
              <div class="mb-3">
                <label for="numBambini" class="form-label">{{ trans('messages.numBambini') }}</label>
                <select class="form-select shadow-none" id="numBambini" name="numBambini">
                </select>
              </div>
            </div>

            <div class="form-three form-step">
              <h2>{{ trans('messages.datiPersonali') }}</h2>
              <div class="mb-3">
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <label for="nome" class="form-label">{{ trans('messages.nome') }}</label>
                    <input class="form-control" type="text" id="nome" name="nome" placeholder="{{ trans('messages.placeholder_nome') }}" />
                    <span class="invalid-input" id="invalid-firstName"></span>
                  </div>
                  <div style="flex: 1;">
                    <label for="cognome" class="form-label">{{ trans('messages.cognome') }}</label>
                    <input class="form-control" type="text" id="cognome" name="cognome" placeholder="{{ trans('messages.placeholder_cognome') }}"/>
                    <span class="invalid-input" id="invalid-lastName"></span>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text"  id="email" name="email" placeholder="{{ trans('messages.placeholder_email') }}" value="{{ session('user_email') ? htmlspecialchars(session('user_email')) : '' }}" />
                <div class="form-text" style="max-width: 424px;">
                  {{ trans('messages.infoEmail') }}
                </div>
                <span class="invalid-input" id="invalid-email"></span>
              </div>
              
              <div class="mb-3">
                <label for="telefono" class="form-label">{{ trans('messages.tel') }}</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="{{ trans('messages.placeholder_telefono') }}">
                <div class="form-text" style="max-width: 424px;">
                  {{ trans('messages.infoTel') }}
                </div>
                <span class="invalid-input" id="invalid-telefono"></span>
              </div>

              <div class="mb-3">
                <label for="stato" class="form-label">{{ trans('messages.stato') }}</label>
                <select class="form-control" id="stato" name="stato">
                  <option value="italia">Italia</option>
                  <option value="francia">Francia</option>
                  <option value="germania">Germania</option>
                  <!-- Aggiungi altre opzioni secondo necessità -->
                </select>
                <span class="invalid-input" id="invalid-stato"></span>
              </div>
              
            </div>
            <div class="form-four form-step">
              <h2 class="mb-3">{{ trans('messages.riepilogo') }}</h2>
              <div class="mb-3">
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <h5>{{ trans('messages.datiPrenotazione') }}</h5>
                    <p id="riepilogo-soggiorno"></p>
                  </div>
                  <div style="flex: 1;">
                    <h5>{{ trans('messages.datiPersonali') }}</h5>
                    <p id="riepilogo-personali"></p>
                  </div>
                </div>
              </div>

              <div class="mb-3"> 
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <h5>{{ trans('messages.numOspiti') }}</h5>
                    <p id="riepilogo-ospiti"></p>
                  </div>     
                  <div style="flex: 1; background-color: var(--main-color); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <h5><strong>{{ trans('messages.prezzo') }}:</strong></h5>
                    <span id="riepilogo-prezzo" class="prezzo-output"></span>
                  </div>     
                </div>
              </div>
            </div>
            <div class="btn-group" style=" display: flex; flex-direction: row; justify-content: center;">
              <button type="button" class="btn-prev" disabled>{{ trans('button.indietro') }}</button>
              <button type="button" class="btn-next">{{ trans('button.avanti') }}</button>
              <label for="mySubmit" class="btn-submit w-100">{{ trans('button.confermaPren') }}<i class="bi bi-check-circle-fill"></i></label>
              <input id="mySubmit" class="d-none btn-submit" type="submit" value="Save">   
            </div>
            <button type="button" class="btn-calendar" onclick="window.location.href='{{ route('calendario') }}'">{{ trans('button.calendario') }}<i class="bi bi-calendar-date" style="margin-left: -7%;"></i></button>
          </form>
        </div>
    </div>
</section>
 @endsection
