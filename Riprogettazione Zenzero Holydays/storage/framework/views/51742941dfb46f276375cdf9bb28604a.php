 <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

<?php $__env->startSection('title'); ?>
<?php if(isset($prenotazione->id)): ?>
    Modifica prenotazione
<?php elseif(isset($arrivo)): ?>
    <?php echo e(trans('messages.conferma')); ?>

<?php else: ?>
    Aggiungi prenotazione
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniAdmin', 'active'); ?>


<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<?php if(isset($prenotazione->id)): ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('prenotazioniAdmin.index')); ?>">Prenotazioni Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifica prenotazione</li>
<?php elseif(isset($arrivo)): ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('messages.conferma')); ?>   </li>
<?php else: ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('prenotazioniAdmin.index')); ?>">Prenotazioni Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Aggiungi prenotazione</li>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<script>
    $(document).ready(function(){
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
                var prenotazioneId = "<?php echo e(isset($prenotazione->id) ? $prenotazione->id : ''); ?>";

                event.preventDefault(); // Impedisce l'invio del modulo
                $.ajax({
                    type: 'GET',
                    url: '<?php echo e(route("ajaxCheckPrenotazione")); ?>',
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
                <?php if(isset($prenotazione->id)): ?>
                    <h1>Modifica prenotazione:</h1>
                <?php elseif(isset($arrivo)): ?>
                    <h1><?php echo e(trans('messages.conferma')); ?></h1>
                <?php else: ?>
                    <h1>Aggiungi prenotazione:</h1>
                <?php endif; ?>
                <?php if(isset($prenotazione->id)): ?>
                    <form class="form-horizontal" name="prenotazioniAdmin" method="post" action="<?php echo e(route('prenotazioniAdmin.update', ['prenotazioniAdmin' => $prenotazione->id])); ?>">
                    <!--<input type="hidden" name="_method" value="PUT">-->
                    <?php echo method_field('PUT'); ?>
                <?php elseif(isset($arrivo)): ?>
                    <form class="form-horizontal" name="prenotazioniUtente" method="post" action="<?php echo e(route('prenotazioniUtente.store')); ?>">
                <?php else: ?>
                    <form class="form-horizontal" name="prenotazioniAdmin" method="post" action="<?php echo e(route('prenotazioniAdmin.store')); ?>">
                <?php endif; ?>
                <?php echo csrf_field(); ?>
                


                <div class="mb-3">
                    <label for="arrivo" class="form-label"><?php echo e(trans('messages.arrivo')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input class="form-control" type="date" id="arrivo" name="arrivo" value="<?php echo e($prenotazione->arrivo); ?>"/>
                    <?php elseif(isset($arrivo)): ?>
                        <input class="form-control" type="date" id="arrivo" name="arrivo" value="<?php echo e($arrivo); ?>"/>
                    <?php else: ?>
                        <input class="form-control" type="date" id="arrivo" name="arrivo"/>
                    <?php endif; ?>
                    <span class="invalid-input" id="invalid-arrivo"></span>
                </div>
                <div class="mb-3">
                    <label for="arrivo" class="form-label"><?php echo e(trans('messages.partenza')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input class="form-control" type="date" id="partenza" name="partenza" value="<?php echo e($prenotazione->partenza); ?>"/>
                    <?php else: ?>
                        <input class="form-control" type="date" id="partenza" name="partenza"/>
                    <?php endif; ?>
                    <span class="invalid-input" id="invalid-partenza"></span>
                </div>
                <div class="mb-3">
                    <label for="numAdulti" class="form-label"><?php echo e(trans('messages.numAdulti')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <select class="form-select shadow-none" name="numAdulti" value="<?php echo e($prenotazione->numAdulti); ?>">
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                            <option value="4">Quattro</option>
                            <option value="5">Cinque</option>
                        </select>
                    <?php else: ?>
                    <select class="form-select shadow-none" name="numAdulti">
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                            <option value="4">Quattro</option>
                            <option value="5">Cinque</option>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                <label for="numBambini" class="form-label"><?php echo e(trans('messages.numBambini')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <select class="form-select shadow-none" name="numBambini" value="<?php echo e($prenotazione->numBambini); ?>">
                            <option value="0">Zero</option>
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                        </select>
                    <?php else: ?>
                        <select class="form-select shadow-none" name="numBambini">
                            <option value="0">Zero</option>
                            <option value="1">Uno</option>
                            <option value="2">Due</option>
                            <option value="3">Tre</option>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="prezzoTotale" class="form-label"><?php echo e(trans('messages.prezzo')); ?></label>
                    <input type="text" class="form-control" id="prezzoTotale" name="prezzoTotale" readonly>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label"><?php echo e(trans('messages.nome')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input class="form-control" type="text" id="nome" name="nome" value="<?php echo e($prenotazione->nome); ?>"/>
                        <span class="invalid-input" id="invalid-firstName"></span>
                    <?php else: ?>
                        <input class="form-control" type="text" id="nome" name="nome"/>
                        <span class="invalid-input" id="invalid-firstName"></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="cognome" class="form-label"><?php echo e(trans('messages.cognome')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input class="form-control" type="text" id="cognome" name="cognome" value="<?php echo e($prenotazione->cognome); ?>"/>
                        <span class="invalid-input" id="invalid-lastName"></span>
                    <?php else: ?>
                        <input class="form-control" type="text" id="cognome" name="cognome"/>
                        <span class="invalid-input" id="invalid-lastName"></span>
                    <?php endif; ?>            
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input class="form-control" type="text" name="email" value="<?php echo e($prenotazione->email); ?>"/>
                        <span class="invalid-input" id="invalid-email"></span>
                    <?php else: ?>
                        <input class="form-control" type="text" name="email"/>
                        <span class="invalid-input" id="invalid-email"></span>
                    <?php endif; ?> 
                </div>
            
                <div class="mb-3">
                    <label for="stato" class="form-label"><?php echo e(trans('messages.stato')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <select class="form-select shadow-none" name="stato" value="<?php echo e($prenotazione->numBambini); ?>">
                            <option value="italia">Italia</option>
                            <option value="francia">Francia</option>
                            <option value="germania">Germania</option>
                                    <!-- Aggiungi altre opzioni secondo necessità -->
                        </select>
                    <?php else: ?>
                        <select class="form-control" id="stato" name="stato">
                            <option value="italia">Italia</option>
                            <option value="francia">Francia</option>
                            <option value="germania">Germania</option>
                                    <!-- Aggiungi altre opzioni secondo necessità -->
                        </select>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label"><?php echo e(trans('messages.tel')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input class="form-control" type="tel" name="telefono" value="<?php echo e($prenotazione->telefono); ?>"/>
                        <span class="invalid-input" id="invalid-telefono"></span>
                    <?php else: ?>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        <span class="invalid-input" id="invalid-telefono"></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="orarioArrivo" class="form-label"><?php echo e(trans('messages.orario')); ?></label>
                    <?php if(isset($prenotazione->id)): ?>
                        <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo" required value="<?php echo e($prenotazione->orarioArrivo); ?>"/>
                    <?php else: ?>
                        <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo" required>
                    <?php endif; ?>
                </div>

                <div class="form-group row mb-3">
                    <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> <?php echo e(trans('messages.salva')); ?></label>
                    <input id="mySubmit" class="d-none" type="submit" value="Save">
                </div>
                <div class="form-group row mb-3">
                        <a class="btn btn-danger w-100" href="<?php echo e(route('prenotazioniAdmin.index')); ?>"><i class="bi bi-box-arrow-left"></i> <?php echo e(trans('messages.annulla')); ?></a>
                </div>

            </form>
            </div>
        </div>
    </div>



    
       
    
<?php $__env->stopSection(); ?>

   
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\GirardelliElaboratoPW\resources\views/adminPrenotazioni/editPrenotazione.blade.php ENDPATH**/ ?>