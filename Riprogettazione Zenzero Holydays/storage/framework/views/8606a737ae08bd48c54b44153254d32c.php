 

<?php $__env->startSection('titolo'); ?>
    Elimina la tua prenotazione
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniUtente','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('prenotazioniUtente.index')); ?>">Prenotazioni</a></li>
<li class="breadcrumb-item active" aria-current="page">Elimina prenotazione</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
    <div class="container-fluid px-lg-4 mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>
                    Stai per cancellare la tua prenotazione dal <?php echo e($prenotazione->arrivo); ?> al <?php echo e($prenotazione->partenza); ?> dal prezzo di €<?php echo e($prenotazione->prezzoTotale); ?>

                </h2>
                <p class="confirm">
                    Confermi?
                </p>
            </div>
        </div>

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
                                <p><strong>Stato Prenotazione:</strong></p>
                                <p><strong>Orario Arrivo:</strong></p>
                            </div>
                            <div class="col-6 text-left">
                                <!-- Colonna per i dati -->
                                <p><?php echo e($prenotazione->arrivo); ?></p>
                                <p><?php echo e($prenotazione->partenza); ?></p>
                                <p><?php echo e($prenotazione->numAdulti); ?></p>
                                <p><?php echo e($prenotazione->numBambini); ?></p>
                                <p>€<?php echo e($prenotazione->prezzoTotale); ?></p>
                                <p><?php echo e($prenotazione->email); ?></p>
                                <p><?php echo e($prenotazione->telefono); ?></p>
                                <p><?php echo e($prenotazione->stato); ?></p>
                                <p><?php echo e($prenotazione->orarioArrivo); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card di conferma cancellazione -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <div class="card border-secondary ">
                    <div class="card-header text-center ">
                        Conferma
                    </div>
                    <div class="card-body text-center">
                        <p>
                            La prenotazione <strong>sarà cancellata</strong>
                        </p>
                        <form name="prenotazione" method="post" action="<?php echo e(route('prenotazioniUtente.destroy', ['prenotazioniUtente' => $prenotazione->id])); ?>">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <label for="mySubmit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> <?php echo e(trans('button.elimina')); ?></label>
                            <input id="mySubmit" class="d-none" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card per annullare la cancellazione -->
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card border-secondary card-custom-width">
                    <div class="card-header text-center">
                        Annulla
                    </div>
                    <div class="card-body text-center">
                        <p>
                            La prenotazione <strong>non sarà cancellata</strong>
                        </p>
                        <a class="btn btn-secondary w-100" href="<?php echo e(route('prenotazioniUtente.index')); ?>"><i class="bi bi-box-arrow-left"></i> <?php echo e(trans('button.annulla')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/utentePrenotazioni/deletePrenotazione.blade.php ENDPATH**/ ?>