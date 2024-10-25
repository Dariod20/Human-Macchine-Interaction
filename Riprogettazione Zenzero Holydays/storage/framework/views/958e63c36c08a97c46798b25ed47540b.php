

<?php $__env->startSection('titolo'); ?>
<?php echo e(trans('messages.conferma')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="<?php echo e(url('/')); ?>/js/phoneValidationScript.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenota', 'active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('calendario')); ?>"><?php echo e(trans(key: 'button.book')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('messages.conferma')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('corpo'); ?>

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
    
    $('form').on('keydown', function(event) {
        if (event.key === "Enter") {
            // Impedisce l'invio della form se ci sono errori di validazione
            event.preventDefault();
        }
    });


    const nextButton = document.querySelector('.btn-next');
    const prevButton = document.querySelector('.btn-prev');
    const steps = document.querySelectorAll('.step');
    const form_step = document.querySelectorAll('.form-step');
    let active = 1;

    // Date arrivano in formato DD-MM-YYYY
    $('#arrivo').val('<?php echo e($arrivo); ?>'); 
    $('#partenza').val('<?php echo e($arrivoDopo); ?>');
    // Converto in formato YYYY-MM-DD per il database
    var arrivo = moment($('#arrivo').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
    var partenza = moment($('#partenza').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
    // Imposto i valori formattati nel campo input
    $('#arrivo').val(arrivo); 
    $('#partenza').val(partenza); 
    updatePrice(arrivo, partenza)

    var lang = '<?php echo e(app()->getLocale()); ?>'
    var minDate = moment().startOf('day'); // Imposta a mezzanotte di oggi

    var  datePicker = $('#daterange')
    
    // Configura il daterangepicker
    datePicker.daterangepicker({
      opens: 'right',
      autoApply: true,
      startDate: '<?php echo e($arrivo); ?>',
      endDate: '<?php echo e($arrivoDopo); ?>',
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
      // Aggiorna il prezzo ogni volta che l'utente seleziona nuove date
      updatePrice(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

        // Nascondi il datepicker all'inizio
    datePicker.data('daterangepicker').hide();

    // Gestisci l'evento focus per nascondere il datepicker
    datePicker.on('focus', function () {
        // Nascondi il datepicker quando il campo è in focus
      $(this).data('daterangepicker').hide();
    });

    // Gestisci l'evento click per aprire il datepicker
    $('#dateRange, #calendarIcon').on('click', function () {
        // Solo se non ci sono errori, apri il datepicker
        
      $(this).data('daterangepicker').show();
        
    });
  
    // Funzione per aggiornare il prezzo
    function updatePrice(arrivo, partenza) {
      if (arrivo && partenza) {
        console.log("Arrivo: ", arrivo); // Debugging
        console.log("Partenza: ", partenza); // Debugging
        $.ajax({
          type: 'GET',
          url: '<?php echo e(route("ajaxCalcolaPrezzoTotale")); ?>',
          data: {
            arrivo: arrivo,
            partenza: partenza
          },
          success: function (data) {
            $('#prezzoTotaleNumero').text(data.prezzoTotale);
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    }


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
            document.getElementById('invalid-arrivo').textContent = "<?php echo e(trans('errors.arrivo')); ?>";
            error = true;
            $("#daterange").focus();
        } else {
            document.getElementById('invalid-arrivo').textContent = "";
        }

        if (partenza.trim() === "") {
            document.getElementById('invalid-arrivo').textContent = "<?php echo e(trans('errors.partenza')); ?>";
            error = true;
            $("#daterange").focus();
        } else {
            document.getElementById('invalid-arrivo').textContent = "";
        }

        if (arrivo && partenza && arrivo >= partenza) {
            document.getElementById('invalid-arrivo').textContent = "<?php echo e(trans('errors.partenzaErr')); ?>";
            $("#daterange").focus();
            error = true;
        }

        if (orarioArrivo.trim() === "") {
            var errorMsg = "<?php echo e(trans('errors.orario')); ?>"; // Usa la sintassi sicura di Laravel
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
            document.getElementById('invalid-firstName').textContent = "<?php echo e(trans('errors.nome')); ?>";
            error = true;
            $("input[name='nome']").focus();
        } else if (!regexName.test(firstName)) {
            document.getElementById('invalid-firstName').textContent = "<?php echo e(trans('errors.nomeErr')); ?>";
            error = true;
            $("input[name='nome']").focus();
        } else {
            document.getElementById('invalid-firstName').textContent = "";
        }

        if (lastName.trim() === "") {
            document.getElementById('invalid-lastName').textContent = "<?php echo e(trans('errors.cognome')); ?>";
            error = true;
            $("input[name='cognome']").focus();
        } else if (!regexName.test(lastName)) {
            document.getElementById('invalid-lastName').textContent = "<?php echo e(trans('errors.cognomeErr')); ?>";
            error = true;
            $("input[name='cognome']").focus();
        } else {
            document.getElementById('invalid-lastName').textContent = "";
        }

        if (telefono.trim() === "") {
            document.getElementById('invalid-telefono').textContent = "<?php echo e(trans('errors.tel')); ?>";
            error = true;
            $("input[name='telefono']").focus();
        } else if (!regexPhone.test(telefono)) {
            document.getElementById('invalid-telefono').textContent = "<?php echo e(trans('errors.telErr')); ?>";
            error = true;
            $("input[name='telefono']").focus();
        } else {
            document.getElementById('invalid-telefono').textContent = "";
        }

        if (email.trim() === "") {
          var errorMsg = "<?php echo e(trans('errors.email')); ?>"; // Usa la sintassi sicura di Laravel
          document.getElementById('invalid-email').textContent = decodeHtmlEntities(errorMsg); // Decodifica l'entità HTML in JavaScript
          error = true;
          $("input[name='email']").focus();
        } else if (!regexEmail.test(email)) {
            document.getElementById('invalid-email').textContent = "<?php echo e(trans('errors.emailErr')); ?>";
            error = true;
            $("input[name='email']").focus();
        } else {
            document.getElementById('invalid-email').textContent = "";
        }

        if (stato.trim() === "") {
            document.getElementById('invalid-stato').textContent = "<?php echo e(trans('errors.stato')); ?>";
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
        var prenotazioneId = "<?php echo e(isset($prenotazione->id) ? $prenotazione->id : ''); ?>";

        $.ajax({
            type: 'GET',
            url: '<?php echo e(route("ajaxCheckPrenotazione")); ?>',
            data: {
                arrivo: arrivo,
                partenza: partenza,
                prenotazioneId: prenotazioneId
            },
            success: function (data) {
                if (data.found) {
                    var occupiedDatesText = "<?php echo e(trans('errors.dateOcc')); ?>";
                    data.occupiedDates.forEach(function (date) {
                        occupiedDatesText += "<?php echo e(trans('errors.dateDal')); ?> " + date.arrivo + " <?php echo e(trans('errors.dateAl')); ?> " + date.partenza + ", ";
                    });
                    occupiedDatesText = occupiedDatesText.slice(0, -2); // Rimuovi l'ultima virgola
                    $("#invalid-arrivo").text(occupiedDatesText);
                    $("#daterange").focus();
                } else {
                  // Chiamata AJAX per verificare le tariffe disponibili
                  $.ajax({
                    type: 'GET',
                    url: '<?php echo e(route("ajaxCheckTariffePrenotazione")); ?>',
                    data: {
                      arrivo: arrivo.trim(),
                      partenza: partenza.trim(),
                      context: "<?php echo e(isset($arrivo) ? 'conferma' : 'altro'); ?>"
                    },
                    success: function (response) {
                      if (!response.available) {
                        error = true;
                        var message = (response.context === 'conferma') ?
                          "<?php echo e(trans('errors.dateChiuse')); ?>" :
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
        const orarioArrivoSelect = document.getElementById("orarioArrivo");
        const orarioArrivo = orarioArrivoSelect.options[orarioArrivoSelect.selectedIndex].text;
        const nome = document.getElementById('nome').value;
        const cognome = document.getElementById('cognome').value;
        const email = document.getElementById('email').value;
        const stato = document.getElementById('stato').value;
        const telefono = document.getElementById('num-telefono').value;
        const prezzo=document.getElementById('prezzoTotaleNumero').innerText;

        document.getElementById('riepilogo-soggiorno').innerHTML = `
          <strong><?php echo e(trans('messages.arrivo')); ?>:</strong> ${arrivo}<br>
          <strong><?php echo e(trans('messages.partenza')); ?>:</strong> ${partenza}<br>
          <strong><?php echo e(trans('messages.orario')); ?>:</strong> ${orarioArrivo}
      `;

      document.getElementById('riepilogo-ospiti').innerHTML = `
          <strong><?php echo e(trans('messages.numAdulti')); ?>:</strong> ${numAdulti}<br>
          <strong><?php echo e(trans('messages.numBambini')); ?>:</strong> ${numBambini}
      `;

      document.getElementById('riepilogo-personali').innerHTML = `
          <strong><?php echo e(trans('messages.nome')); ?>:</strong> ${nome} <strong><?php echo e(trans('messages.cognome')); ?>:</strong> ${cognome}<br>
          <strong><?php echo e(trans('messages.email')); ?>:</strong> ${email}<br>
          <strong><?php echo e(trans('messages.tel')); ?>:</strong> ${telefono}<br>
          <strong><?php echo e(trans('messages.stato')); ?>:</strong> ${stato}<br>`;
          

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
                <p><?php echo e(trans('messages.datiPrenotazione')); ?></p>
              </li>
              <li class="step">
                <span>2</span>
                <p><?php echo e(trans('messages.numOspiti')); ?></p>
              </li>
              <li class="step">
                <span>3</span>
                <p><?php echo e(trans('messages.datiPersonali')); ?></p>
              </li>
              <li class="step">
                <span>4</span>
                <p><?php echo e(trans('messages.riepilogo')); ?></p>
              </li>
            </ul>
          </div>
          <form name="prenotazioniUtente" method="post" action="<?php echo e(route('prenotazioniUtente.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-one form-step active">
              <h2><?php echo e(trans('messages.datiPrenotazione')); ?></h2>
              <div class="mb-3">
                <label for="daterange" class="form-label"><?php echo e(trans('messages.dateRange')); ?></label>
                <div class="input-group date">
                  <input class="form-control" type="text" id="daterange" name="daterange" />
                  <span class="input-group-addon">
                    <i class="bi bi-calendar-date" aria-hidden="true"></i>
                  </span>
                </div>
                <span class="invalid-input" id="invalid-arrivo"></span>
              </div>
              <!-- Campi nascosti per inviare arrivo e partenza -->
              <input type="hidden" id="arrivo" name="arrivo" value="<?php echo e($arrivo); ?>">
              <input type="hidden" id="partenza" name="partenza">
              <div class="mb-3">
                <label for="orarioArrivo" class="form-label"><?php echo e(trans('messages.orario')); ?></label>
                <div class="input-group date">
                  <select class="form-control" id="orarioArrivo" name="orarioArrivo">
                    <option value="" disabled selected><?php echo e(trans('messages.selezionaOrario')); ?></option>
                    <option value="00:00:00">00:00 - 01:00</option>
                    <option value="01:00:00">01:00 - 02:00</option>
                    <option value="02:00:00">02:00 - 03:00</option>
                    <option value="03:00:00">03:00 - 04:00</option>
                    <option value="04:00:00">04:00 - 05:00</option>
                    <option value="05:00:00">05:00 - 06:00</option>
                    <option value="06:00:00">06:00 - 07:00</option>
                    <option value="07:00:00">07:00 - 08:00</option>
                    <option value="08:00:00">08:00 - 09:00</option>
                    <option value="09:00:00">09:00 - 10:00</option>
                    <option value="10:00:00">10:00 - 11:00</option>
                    <option value="11:00:00">11:00 - 12:00</option>
                    <option value="12:00:00">12:00 - 13:00</option>
                    <option value="13:00:00">13:00 - 14:00</option>
                    <option value="14:00:00">14:00 - 15:00</option>
                    <option value="15:00:00">15:00 - 16:00</option>
                    <option value="16:00:00">16:00 - 17:00</option>
                    <option value="17:00:00">17:00 - 18:00</option>
                    <option value="18:00:00">18:00 - 19:00</option>
                    <option value="19:00:00">19:00 - 20:00</option>
                    <option value="20:00:00">20:00 - 21:00</option>
                    <option value="21:00:00">21:00 - 22:00</option>
                    <option value="22:00:00">22:00 - 23:00</option>
                    <option value="23:00:00">23:00 - 00:00</option>
                  </select>
                  <span class="input-group-addon">
                    <i class="bi bi-clock" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="form-text" style="max-width: 400px;">
                  <?php echo e(trans('messages.infoOrario')); ?>

                </div>
                <span class="invalid-input" id="invalid-orarioArrivo"></span>
              </div>
              <div class="form-group" style="background-color: var(--main-color); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <label><?php echo e(trans('messages.prezzo')); ?>:</label>
                <div id="prezzoTotale" class="prezzo-output">€<span id="prezzoTotaleNumero">0.00</span></div>
              </div>
            </div>
            <div class="form-two form-step">
              <h2><?php echo e(trans('messages.numOspiti')); ?></h2>
              <div class="mb-3">
                <label for="numAdulti" class="form-label"><?php echo e(trans('messages.numAdulti')); ?></label>
                <select class="form-select shadow-none" id="numAdulti" name="numAdulti" onchange="populate(this.id,'numBambini')">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
                <div class="form-text" style="max-width: 300px;">
                  <?php echo e(trans('messages.infoLetti')); ?>

                </div>
              </div>
              <div class="mb-3">
                <label for="numBambini" class="form-label"><?php echo e(trans('messages.numBambini')); ?></label>
                <select class="form-select shadow-none" id="numBambini" name="numBambini">
                </select>
              </div>
            </div>

            <div class="form-three form-step">
              <h2><?php echo e(trans('messages.datiPersonali')); ?></h2>
              <div class="mb-3">
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <label for="nome" class="form-label"><?php echo e(trans('messages.nome')); ?></label>
                    <input class="form-control" type="text" id="nome" name="nome" placeholder="<?php echo e(trans('messages.placeholder_nome')); ?>" />
                    <span class="invalid-input" id="invalid-firstName"></span>
                  </div>
                  <div style="flex: 1;">
                    <label for="cognome" class="form-label"><?php echo e(trans('messages.cognome')); ?></label>
                    <input class="form-control" type="text" id="cognome" name="cognome" placeholder="<?php echo e(trans('messages.placeholder_cognome')); ?>"/>
                    <span class="invalid-input" id="invalid-lastName"></span>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text"  id="email" name="email" placeholder="<?php echo e(trans('messages.placeholder_email')); ?>" value="<?php echo e(session('user_email') ? htmlspecialchars(session('user_email')) : ''); ?>" />
                <div class="form-text" style="max-width: 424px;">
                  <?php echo e(trans('messages.infoEmail')); ?>

                </div>
                <span class="invalid-input" id="invalid-email"></span>
              </div>

              <div class="mb-3">
                <label for="stato" class="form-label"><?php echo e(trans('messages.stato')); ?></label>
                <select class="form-control" id="stato" name="stato">
                  <option value="" disabled selected><?php echo e(trans('messages.placeholder_stato')); ?></option>
                  <!-- Opzioni generate dinamicamente con JavaScript -->
                </select>
                <span class="invalid-input" id="invalid-stato"></span>
              </div>
              
              <div class="mb-3">
                <label for="telefono" class="form-label"><?php echo e(trans('messages.tel')); ?></label>
                <div class="select-box">
                  <div class="selected-option">
                    <div>
                      <span class="iconify" data-icon="flag:gb-4x3"></span>
                      <strong>+1</strong>
                    </div>
                    <input type="tel" class="form-control" id="telefono" name="tel" placeholder="<?php echo e(trans('messages.placeholder_telefono')); ?>">
                  </div>
                  <div class="options">
                    <input type="text" class="search-box" placeholder="Search Country Name">
                    <ol>
                
                    </ol>
                  </div>
                </div>
                <div class="form-text" style="max-width: 424px;">
                  <?php echo e(trans('messages.infoTel')); ?>

                </div>
                <span class="invalid-input" id="invalid-telefono"></span>
                <input type="hidden" id="num-telefono" name="num-telefono">
              </div>

            

    
              
            </div>
            <div class="form-four form-step">
              <h2 class="mb-3"><?php echo e(trans('messages.riepilogo')); ?></h2>
              <div class="mb-3">
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <h5><?php echo e(trans('messages.datiPrenotazione')); ?></h5>
                    <p id="riepilogo-soggiorno"></p>
                  </div>
                  <div style="flex: 1;">
                    <h5><?php echo e(trans('messages.datiPersonali')); ?></h5>
                    <p id="riepilogo-personali"></p>
                  </div>
                </div>
              </div>

              <div class="mb-3"> 
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <h5><?php echo e(trans('messages.numOspiti')); ?></h5>
                    <p id="riepilogo-ospiti"></p>
                  </div>     
                  <div style="flex: 1; background-color: var(--main-color); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <h5><strong><?php echo e(trans('messages.prezzo')); ?>:</strong></h5>
                    <span id="riepilogo-prezzo" class="prezzo-output"></span>
                  </div>     
                </div>
              </div>
            </div>
            <div class="btn-group" style=" display: flex; flex-direction: row; justify-content: center;">
              <button type="button" class="btn-prev" disabled><?php echo e(trans('button.indietro')); ?></button>
              <button type="button" class="btn-next"><?php echo e(trans('button.avanti')); ?></button>
              <label for="mySubmit" class="btn-submit w-100"><?php echo e(trans('button.confermaPren')); ?><i class="bi bi-check-circle-fill"></i></label>
              <input id="mySubmit" class="d-none btn-submit" type="submit" value="Save">   
            </div>
            <button type="button" class="btn-calendar" onclick="window.location.href='<?php echo e(route('calendario')); ?>'"><?php echo e(trans('button.calendario')); ?><i class="bi bi-calendar-date" style="margin-left: -7%;"></i></button>
          </form>
        </div>
    </div>
</section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/utentePrenotazioni/confirmPrenotazione.blade.php ENDPATH**/ ?>