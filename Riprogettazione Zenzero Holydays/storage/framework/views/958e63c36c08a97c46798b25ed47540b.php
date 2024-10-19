

<?php $__env->startSection('titolo'); ?>
<?php echo e(trans('messages.conferma')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenota', 'active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('messages.conferma')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('corpo'); ?>

<script>
  $(document).ready(function(){
    const nextButton = document.querySelector('.btn-next');
    const prevButton = document.querySelector('.btn-prev');
    const steps = document.querySelectorAll('.step');
    const form_step = document.querySelectorAll('.form-step');
    let active = 1;

    $('#arrivo, #partenza').change(function() {
        var arrivo = $('#arrivo').val();
        var partenza = $('#partenza').val();

        if (arrivo && partenza) {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(route("ajaxCalcolaPrezzoTotale")); ?>',
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
            if (validateStep2()) {
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
        console.log('steps.length  =>' + steps.length);
        console.log('active => ' + active);

        steps.forEach((step, i) => {
            if (i == active - 1) {
                step.classList.add('active');
                form_step[i].classList.add('active');
                console.log('i =>'+ i);
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

    // Validazione del primo step
    function validateStep1() {
        var arrivo = document.getElementById('arrivo').value;
        var partenza = document.getElementById('partenza').value;
        var numAdulti = document.getElementById('numAdulti').value;
        var numBambini = document.getElementById('numBambini').value;
        var orarioArrivo = document.getElementById('orarioArrivo').value;
        var error = false;

        if (arrivo.trim() === "") {
            document.getElementById('invalid-arrivo').textContent = "La data di arrivo è obbligatoria.";
            error = true;
            $("#arrivo").focus();
        } else {
            document.getElementById('invalid-arrivo').textContent = "";
        }

        if (partenza.trim() === "") {
            document.getElementById('invalid-partenza').textContent = "La data di partenza è obbligatoria.";
            error = true;
            $("#partenza").focus();
        } else {
            document.getElementById('invalid-partenza').textContent = "";
        }

        if (arrivo && partenza && arrivo >= partenza) {
            document.getElementById('invalid-arrivo').textContent = "La data di arrivo deve precedere la partenza.";
            document.getElementById('invalid-partenza').textContent = "La data di partenza deve essere successiva alla data di arrivo.";
            $("#partenza").focus();
            error = true;
        }

        if (orarioArrivo.trim() === "") {
            document.getElementById('invalid-orarioArrivo').textContent = "L'orario di arrivo è obbligatorio.";
            error = true;
            $("#orarioArrivo").focus();
        } else {
            document.getElementById('invalid-orarioArrivo').textContent = "";
        }

        return !error; // Ritorna true se non ci sono errori
    }

    // Validazione del secondo step
    function validateStep2() {
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
            document.getElementById('invalid-firstName').textContent = "Il nome è obbligatorio.";
            error = true;
            $("input[name='nome']").focus();
        } else if (!regexName.test(firstName)) {
            document.getElementById('invalid-firstName').textContent = "Il nome deve contenere solo lettere.";
            error = true;
            $("input[name='nome']").focus();
        } else {
            document.getElementById('invalid-firstName').textContent = "";
        }

        if (lastName.trim() === "") {
            document.getElementById('invalid-lastName').textContent = "Il cognome è obbligatorio.";
            error = true;
            $("input[name='cognome']").focus();
        } else if (!regexName.test(lastName)) {
            document.getElementById('invalid-lastName').textContent = "Il cognome deve contenere solo lettere.";
            error = true;
            $("input[name='cognome']").focus();
        } else {
            document.getElementById('invalid-lastName').textContent = "";
        }

        if (telefono.trim() === "") {
            document.getElementById('invalid-telefono').textContent = "Il numero di telefono è obbligatorio.";
            error = true;
            $("input[name='telefono']").focus();
        } else if (!regexPhone.test(telefono)) {
            document.getElementById('invalid-telefono').textContent = "Il numero di telefono deve contenere solo cifre.";
            error = true;
            $("input[name='telefono']").focus();
        } else {
            document.getElementById('invalid-telefono').textContent = "";
        }

        if (email.trim() === "") {
            document.getElementById('invalid-email').textContent = "L'email è obbligatoria.";
            error = true;
            $("input[name='email']").focus();
        } else if (!regexEmail.test(email)) {
            document.getElementById('invalid-email').textContent = "Inserisci un'email valida.";
            error = true;
            $("input[name='email']").focus();
        } else {
            document.getElementById('invalid-email').textContent = "";
        }

        if (stato.trim() === "") {
            document.getElementById('invalid-stato').textContent = "Lo Stato è obbligatorio.";
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
                    console.log(data)
                    var occupiedDatesText = "Alcune delle date inserite sono già occupate. Ci sono già prenotazioni: ";
                    data.occupiedDates.forEach(function (date) {
                        occupiedDatesText += "dal " + date.arrivo + " al " + date.partenza + ", ";
                    });
                    occupiedDatesText = occupiedDatesText.slice(0, -2); // Rimuovi l'ultima virgola
                    $("#invalid-arrivo").text(occupiedDatesText);
                    $("#invalid-partenza").text(occupiedDatesText);
                    $("#partenza").focus();
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
                          "La casa vacanze è chiusa in queste date, controllare il calendario" :
                          response.message;
                        $("#invalid-arrivo").text(message);
                        $("#invalid-partenza").text(message);
                        $("#arrivo").focus();
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
        const arrivo = document.getElementById('arrivo').value;
        const partenza = document.getElementById('partenza').value;
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
          <strong>Arrivo:</strong> ${arrivo}<br>
          <strong>Partenza:</strong> ${partenza}<br>
          <strong>Orario di arrivo:</strong> ${orarioArrivo}
      `;

      document.getElementById('riepilogo-ospiti').innerHTML = `
          <strong>Adulti:</strong> ${numAdulti} <strong>Bambini:</strong> ${numBambini}
      `;

      document.getElementById('riepilogo-personali').innerHTML = `
          <strong>Nome:</strong> ${nome} <strong>Cognome:</strong> ${cognome}<br>
          <strong>Email:</strong> ${email}<br>
          <strong>Stato:</strong> ${stato}<br>
          <strong>Telefono:</strong> ${telefono}`;

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
                <p>Dati del soggiorno</p>
              </li>
              <li class="step">
                <span>2</span>
                <p>Numero di ospiti</p>
              </li>
              <li class="step">
                <span>3</span>
                <p>Dati personali</p>
              </li>
              <li class="step">
                <span>4</span>
                <p>Riepilogo</p>
              </li>
            </ul>
          </div>
          <form name="prenotazioniUtente" method="post" action="<?php echo e(route('prenotazioniUtente.store')); ?>">
            <div class="form-one form-step active">
              <h2>Dati del soggiorno</h2>
              <div>
                <label for="arrivo" class="form-label"><?php echo e(trans('messages.arrivo')); ?></label>       
                <input class="form-control" type="date" id="arrivo" name="arrivo" value="<?php echo e($arrivo); ?>"/>
                <span class="invalid-input" id="invalid-arrivo"></span>
              </div>
              <div>
                <label for="arrivo" class="form-label"><?php echo e(trans('messages.partenza')); ?></label>
                <input class="form-control" type="date" id="partenza" name="partenza"/>
                <span class="invalid-input" id="invalid-partenza"></span>
              </div>
              <div class="mb-3">
                <label for="orarioArrivo" class="form-label"><?php echo e(trans('messages.orario')); ?></label>
                <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo">
                <span class="invalid-input" id="invalid-orarioArrivo"></span>
              </div>
              <div class="form-group" style="background-color: var(--main-color); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <label>Prezzo Totale:</label>
                <div id="prezzoTotale" class="prezzo-output">€<span id="prezzoTotaleNumero">0.00</span></div>
              </div>
            </div>
            <div class="form-two form-step">
              <h2>Numero di ospiti</h2>
              <div class="mb-3">
                <label for="numAdulti" class="form-label"><?php echo e(trans('messages.numAdulti')); ?></label>
                <select class="form-select shadow-none" id="numAdulti" name="numAdulti">
                  <option value="1">Uno</option>
                  <option value="2">Due</option>
                  <option value="3">Tre</option>
                  <option value="4">Quattro</option>
                  <option value="5">Cinque</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="numBambini" class="form-label"><?php echo e(trans('messages.numBambini')); ?></label>
                <select class="form-select shadow-none" id="numBambini" name="numBambini">
                  <option value="0">Zero</option>
                  <option value="1">Uno</option>
                  <option value="2">Due</option>
                  <option value="3">Tre</option>
                </select>
              </div>
            </div>

            <div class="form-three form-step">
              <h2>Dati personali</h2>
              <div class="mb-3">
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <label for="nome" class="form-label"><?php echo e(trans('messages.nome')); ?></label>
                    <input class="form-control" type="text" id="nome" name="nome" placeholder="<?php echo e(trans('messages.nome')); ?>" />
                    <span class="invalid-input" id="invalid-firstName"></span>
                  </div>
                  <div style="flex: 1;">
                    <label for="cognome" class="form-label"><?php echo e(trans('messages.cognome')); ?></label>
                    <input class="form-control" type="text" id="cognome" name="cognome" />
                    <span class="invalid-input" id="invalid-lastName"></span>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text"  id="email" name="email" />
                <span class="invalid-input" id="invalid-email"></span>
              </div>
              
              <div class="mb-3">
                <label for="telefono" class="form-label"><?php echo e(trans('messages.tel')); ?></label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                <span class="invalid-input" id="invalid-telefono"></span>
              </div>

              <div class="mb-3">
                <label for="stato" class="form-label"><?php echo e(trans('messages.stato')); ?></label>
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
              <h2 class="mb-3">Riepilogo dati prenotazione</h2>
              <div class="mb-3">
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <h5>Dati del soggiorno:</h5>
                    <p id="riepilogo-soggiorno"></p>
                  </div>
                  <div style="flex: 1;">
                    <h5>Dati personali:</h5>
                    <p id="riepilogo-personali"></p>
                  </div>
                </div>
              </div>

              <div class="mb-3"> 
                <div style="display: flex; gap: 10px;">
                  <div style="flex: 1;">
                    <h5>Numero ospiti:</h5>
                    <p id="riepilogo-ospiti"></p>
                  </div>     
                  <div style="flex: 1; background-color: var(--main-color); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <h5><strong>Prezzo:</strong></h5>
                    <span id="riepilogo-prezzo" class="prezzo-output"></span>
                  </div>     
                </div>
              </div>
            </div>
            <div class="btn-group" style=" display: flex; flex-direction: row; justify-content: center;">
              <button type="button" class="btn-prev" disabled>Indietro</button>
              <button type="button" class="btn-next">Avanti</button>
              <label for="mySubmit" class="btn-submit w-100"><i class="bi bi-floppy2-fill"></i> <?php echo e(trans('messages.salva')); ?></label>
              <input id="mySubmit" class="d-none btn-submit" type="submit" value="Save">
            </div>
          </form>
        </div>
    </div>
</section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/utentePrenotazioni/confirmPrenotazione.blade.php ENDPATH**/ ?>