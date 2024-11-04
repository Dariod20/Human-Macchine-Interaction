 <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

<?php $__env->startSection('titolo'); ?>
<?php if(isset($tariffa->id)): ?>
    Modifica tariffa
<?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
<?php echo e(trans('messages.edit_rate_group')); ?>

<?php else: ?>
    Aggiungi gruppo di tariffe
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script> var lang = '<?php echo e(app()->getLocale()); ?>'</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_tariffe', 'active'); ?>


<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('tariffeAdmin.index')); ?>">Tariffe</a></li>
<?php if(isset($tariffa->id)): ?>
    <li class="breadcrumb-item active" aria-current="page">Modifica tariffa</li>
<?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('messages.edit_rate_group')); ?></li>
<?php else: ?>
    <li class="breadcrumb-item active" aria-current="page">Aggiungi gruppo di tariffe</li>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<script>

    function decodeHtmlEntities(str) {
      var txt = document.createElement("textarea");
      txt.innerHTML = str;
      return txt.value;
    }

    $(document).ready(function(){


        
        var lang = '<?php echo e(app()->getLocale()); ?>';
        var  datePicker = $('#daterange');

        var isAddForm = '<?php echo e(Route::currentRouteName()); ?>' === 'tariffeAdmin.create'; // Assicurati di usare il nome della rotta corretto

        var startDate = moment().startOf('day'); // Imposta a mezzanotte di oggi
        var endDate = moment().endOf('day'); // Imposta alla fine dell'ora di oggi
                // Verifica se minDate e maxDate sono disponibili
        var minDate = '<?php echo e(isset($minDate) ? $minDate : ''); ?>';
        var maxDate = '<?php echo e(isset($maxDate) ? $maxDate : ''); ?>';

        let formattedMinDate = minDate.split('-').reverse().join('/');
        let formattedMaxDate = maxDate.split('-').reverse().join('/');

        // Configura il daterangepicker
        datePicker.daterangepicker({
            opens: 'right',
            autoApply: true,
            startDate: startDate,
            endDate: endDate,
            ...(isAddForm ? {} : {
                    minDate: formattedMinDate,
                    maxDate: formattedMaxDate,
                }),
            
            locale: {
                format: 'DD/MM/YYYY', // Imposta il formato corretto
                firstDay: 1, // Setta il lunedì come primo giorno per 'it', domenica per 'en'
                daysOfWeek: lang === 'it' ? ["Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"] : ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                monthNames: lang === 'it' ? [
                    "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno",
                    "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"
                ] : [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ]
            }

        }, function (start, end, label) {
            $('#giorno').val(start.format('YYYY-MM-DD'));
            $('#giornoFino').val(end.format('YYYY-MM-DD'));
        
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




        $("form").submit(function(event) {
            var error = false;
            var giorno = $("input[name='giorno']").val();
            var prezzo = $("input[name='prezzo']").val();
            var giorno_fino = $("input[name='giornoFino']").val();
            var isEditGruppo = $("input[name='isEditGruppo']").val() === "true"; // Nuovo campo
            var isAddGruppo = $("input[name='isAddGruppo']").val() === "true"; // Nuovo campo

                 
            

            if (isEditGruppo || isAddGruppo){
                if (giorno_fino.trim() === "") {
                    error = true;
                    $("#invalid-giorno_fino").text("<?php echo e(trans('errors.giornoFine')); ?>");
                    event.preventDefault();
                    $("#daterange").focus();
                } else {
                    $("#invalid-giorno_fino").text("");
                }

                if (giorno.trim() === "") {
                    error = true;
                    $("#invalid-giorno").text("<?php echo e(trans('errors.giorno')); ?>");
                    event.preventDefault();
                    $("#daterange").focus();
                } else {
                    $("#invalid-giorno").text("");
                }

                if(giorno.trim() !== "" && giorno_fino.trim() !== "" && giorno > giorno_fino) {
                    error = true;
                    var errorMsg = "<?php echo e(trans('errors.giornoErr')); ?>"; // Usa la sintassi sicura di Laravel
                    document.getElementById('invalid-giorno').textContent = decodeHtmlEntities(errorMsg); // Decodifica l'entità HTML in JavaScript
                    var errorMsg = "<?php echo e(trans('errors.giornoFinoErr')); ?>"; // Usa la sintassi sicura di Laravel
                    document.getElementById('invalid-giorno_fino').textContent = decodeHtmlEntities(errorMsg); // Decodifica l'entità HTML in JavaScript

                    
                    event.preventDefault();
                    $("#daterange").focus();
                }else{
                    $("#invalid-giorno_fino").text("");
                }
            } else {
                if (giorno.trim() === "") {
                    error = true;
                    event.preventDefault();
                    $("#invalid-giorno").text("<?php echo e(trans('errors.giornoTariffa')); ?>");
                    $("#giorno").focus();
                }else {
                    $("#invalid-giorno").text("");
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

                    url: '<?php echo e(route("ajaxCheckTariffa")); ?>',

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

    <section id="form-admin">
    <div class="container-fluid px-lg-4">
        
        <div class="row justify-content-center">
            <div class="col-md-5">
            <div class="form-admin">
                <?php if(isset($tariffa->id)): ?>
                    <h1 class="text-center mt-3 mb-3">Modifica tariffa:</h1>
                <?php elseif(Route::currentRouteName() === 'tariffeAdmin.editGruppo'): ?>
                    <h1 class="text-center mt-3 mb-3"><?php echo e(trans('messages.edit_rate_group')); ?></h1>
                <?php else: ?>
                    <h1 class="text-center mt-3 mb-3">Aggiungi gruppo di tariffe:</h1>
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
                <input type="hidden" name="isAddGruppo" value="<?php echo e(Route::currentRouteName() === 'tariffeAdmin.create' ? 'true' : 'false'); ?>">


                <div class="mb-4">
                    <?php if((Route::currentRouteName() === 'tariffeAdmin.editGruppo') || (Route::currentRouteName() === 'tariffeAdmin.create')): ?>
                        <div>
                            <label for="daterange" class="form-label"><?php echo e(trans('messages.range_mod')); ?></label>
                            <div class="input-group date">
                                <input class="form-control" type="text" id="daterange" name="daterange" />
                                <span class="input-group-addon">
                                    <i class="bi bi-calendar-date" aria-hidden="true"></i>
                                </span>
                            </div>
                            <span class="invalid-input" id="invalid-arrivo"></span>
                        </div>
                        <!-- Campi nascosti per inviare giorno e giornoFino -->
                        <input type="hidden" id="giorno" name="giorno">
                        <input type="hidden" id="giornoFino" name="giornoFino">
                    <?php else: ?>
                        <label for="giorno" class="form-label">Giorno</label>
                    <?php endif; ?>
                    <?php if(isset($tariffa->id)): ?>
                        <input class="form-control" type="date" id="giorno" name="giorno" value="<?php echo e($tariffa->giorno); ?>"/>
                    <?php endif; ?>
                    <span class="invalid-input" id="invalid-giorno"></span>
                    <span class="invalid-input" id="invalid-giorno_fino"></span>
                </div>
                

                <div class="mb-4">
                    <label for="prezzo" class="form-label"><?php echo e(trans('messages.rate')); ?></label>
                    <?php if(isset($tariffa->id)): ?>
                        <input class="form-control" type="number" id="prezzo" name="prezzo" value="<?php echo e($tariffa->prezzo); ?>"/>
                    <?php else: ?>
                        <input class="form-control" type="number" id="prezzo" name="prezzo" placeholder="<?php echo e(trans('messages.placeholder_prezzo')); ?>"/>
                    <?php endif; ?>
                    <span class="invalid-input" id="invalid-prezzo"></span>
                </div>

                <div class="form-group mb-3"> 
                <?php if(isset($tariffa->id) || isset($minDate) || isset($maxDate)): ?>
                    <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> <?php echo e(trans('messages.save_changes')); ?></label>
                <?php else: ?>
                    <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> <?php echo e(trans('messages.save_add')); ?></label>
                <?php endif; ?>
                    <input id="mySubmit" class="d-none" type="submit" value="Save">
                </div>
                <div class="form-group mb-3">
                    <a class="btn btn-danger w-100" href="<?php echo e(route('tariffeAdmin.index')); ?>"><i class="bi bi-box-arrow-left"></i> <?php echo e(trans('messages.annulla')); ?></a>
                </div>

            </form>
            </div>
            </div>
        </div>
    </div>
    </section>



    
       
    
<?php $__env->stopSection(); ?>

   
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/adminTariffe/editTariffa.blade.php ENDPATH**/ ?>