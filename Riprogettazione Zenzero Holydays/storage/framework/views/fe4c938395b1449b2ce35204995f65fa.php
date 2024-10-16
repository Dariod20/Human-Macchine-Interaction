 <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

<?php $__env->startSection('title'); ?>
<?php if(isset($tariffa->id)): ?>
    Modifica tariffa
<?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
    Modifica gruppo di tariffe
<?php else: ?>
    Crea nuova tariffa
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_tariffe', 'active'); ?>


<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('tariffeAdmin.index')); ?>">Tariffe</a></li>
<?php if(isset($tariffa->id)): ?>
    <li class="breadcrumb-item active" aria-current="page">Modifica tariffa</li>
<?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
    <li class="breadcrumb-item active" aria-current="page">Modifica gruppo di tariffe</li>
<?php else: ?>
    <li class="breadcrumb-item active" aria-current="page">Aggiungi tariffa</li>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<script>
    $(document).ready(function(){
        $("form").submit(function(event) {
            var error = false;
            var giorno = $("input[name='giorno']").val();
            var prezzo = $("input[name='prezzo']").val();
            var giorno_fino = $("input[name='giornoFino']").val();
            var isEditGruppo = $("input[name='isEditGruppo']").val() === "true"; // Nuovo campo
                 
            if (giorno.trim() === "") {
                error = true;
                $("#invalid-giorno").text("Il giorno è obbligatorio.");
                event.preventDefault();
                $("#giorno").focus();
            } else {
                $("#invalid-giorno").text("");
            }

            
            if (isEditGruppo && giorno_fino.trim() === "") {
                error = true;
                $("#invalid-giorno_fino").text("Il giorno è obbligatorio.");
                event.preventDefault();
                $("#giorno_fino").focus();
            } else if(isEditGruppo && giorno.trim() !== "" && giorno_fino.trim() !== "" && giorno > giorno_fino) {
                error = true;
                $("#invalid-giorno").text("Il giorno selezionato deve essere uguale o precedente alla data 'Fino al giorno'. Per favore, seleziona una data valida.");
                event.preventDefault();
                $("#giorno").focus();
            }else{
                $("#invalid-giorno_fino").text("");
            }

            if (prezzo.trim() === "") {
                error = true;
                $("#invalid-prezzo").text("Il prezzo è obbligatorio.");
                event.preventDefault();
                $("#prezzo").focus();
            } else {
                $("#invalid-prezzo").text("");
            }

            if(!error)
            {
                
                var metodoHttp = $('input[name="_method"]').val();
                 // la pagina è state caricata per creare una nuova tariffa
                if (metodoHttp === undefined && !isEditGruppo){
                    event.preventDefault(); // Impedisce l'invio del modulo
                    $.ajax({

                    type: 'GET',

                    url: '<?php echo e(route("ajaxCheckTariffa")); ?>',

                    data: { giorno: giorno.trim() },

                    success: function (data) {

                        if (data.found) {
                            error = true;
                            $("#invalid-giorno").text("Una tariffa con questo giorno esiste già nel database.");
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
                        url: '<?php echo e(route("tariffeAdmin.ajaxCheckTariffePrenotazioni")); ?>',
                        data: { giorno: giorno.trim(), giornoFino: giorno_fino.trim() },
                        success: function (data) {
                            if (data.hasBookings) {
                                $("#invalid-giorno").text("Esistono prenotazioni associate alle tariffe nei seguenti giorni: " + data.bookedDays.join(', '));
                            } else {
                                $.ajax({
                                type: 'GET',
                                url: '<?php echo e(route("ajaxCheckTariffePrenotazione")); ?>',
                                data: {
                                    arrivo: giorno.trim(),
                                    partenza: giorno_fino.trim(),
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
                <?php if(isset($tariffa->id)): ?>
                    <h1>Modifica tariffa:</h1>
                <?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
                    <h1>Modifica gruppo di tariffe</h1>
                <?php else: ?>
                    <h1>Aggiungi tariffa:</h1>
                <?php endif; ?>
                <?php if(isset($tariffa->id)): ?>
                    <form class="form-horizontal" name="tariffeAdmin" method="post" action="<?php echo e(route('tariffeAdmin.update', ['tariffeAdmin' => $tariffa->id])); ?>">
                    <?php echo method_field('PUT'); ?>
                <?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
                    <form class="form-horizontal" name="tariffeAdmin" method="post" action="<?php echo e(route('tariffeAdmin.updateGruppo')); ?>" >
                    <?php echo csrf_field(); ?>
                <?php else: ?>
                    <form class="form-horizontal" name="tariffeAdmin" method="post" action="<?php echo e(route('tariffeAdmin.store')); ?>">
                <?php endif; ?>
                <?php echo csrf_field(); ?>

                <input type="hidden" name="isEditGruppo" value="<?php echo e(Route::currentRouteName() === 'tariffeAdmin.editGruppo' ? 'true' : 'false'); ?>">


                <div class="mb-3">
                    <label for="giorno" class="form-label">Giorno</label>
                    <?php if(isset($tariffa->id)): ?>
                        <input class="form-control" type="date" id="giorno" name="giorno" value="<?php echo e($tariffa->giorno); ?>"/>
                    <?php else: ?>
                        <input class="form-control" type="date" id="giorno" name="giorno"/>
                    <?php endif; ?>
                    <span class="invalid-input" id="invalid-giorno"></span>
                </div>
                <?php if(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
                    <div class="mb-3" id="giorno_fino_container">
                        <label for="giorno_fino" class="form-label">Fino al giorno</label>
                        <input class="form-control" type="date" id="giorno_fino" name="giornoFino" />
                        <span class="invalid-input" id="invalid-giorno_fino"></span>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="prezzo" class="form-label">Prezzo</label>
                    <?php if(isset($tariffa->id)): ?>
                        <input class="form-control" type="number" id="prezzo" name="prezzo" value="<?php echo e($tariffa->prezzo); ?>"/>
                    <?php else: ?>
                        <input class="form-control" type="number" id="prezzo" name="prezzo"/>
                    <?php endif; ?>
                    <span class="invalid-input" id="invalid-prezzo"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Salva</label>
                    <input id="mySubmit" class="d-none" type="submit" value="Save">
                </div>
                <div class="form-group mb-3">
                    <a class="btn btn-danger w-100" href="<?php echo e(route('tariffeAdmin.index')); ?>"><i class="bi bi-box-arrow-left"></i> Annulla</a>
                </div>

            </form>
            </div>
        </div>
    </div>



    
       
    
<?php $__env->stopSection(); ?>

   
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/adminTariffe/editTariffa.blade.php ENDPATH**/ ?>