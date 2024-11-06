 

<?php $__env->startSection('titolo'); ?>
    Elimina prenotazione
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniAdmin','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('prenotazioniAdmin.index')); ?>">Prenotazioni Admin</a></li>
<li class="breadcrumb-item active" aria-current="page">Elimina prenotazione</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('corpo'); ?>


<section id="form-admin">
    <div class="container-fluid px-lg-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">

                    <div class="container-fluid mt-4" style="padding: inherit;">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <h2>
                                    Stai per cancellare la prenotazione di "<?php echo e($prenotazione->nome); ?> <?php echo e($prenotazione->cognome); ?>"
                                </h2>
                            </div>
                        </div>

                        <div id="inner">
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
                                                    <p><strong>Stato:</strong></p>
                                                    <p><strong>Orario Arrivo:</strong></p>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <!-- Colonna per i dati -->
                                                    <p><?php echo e(\Carbon\Carbon::parse($prenotazione->arrivo)->format('d/m/Y')); ?></p>
                                                    <p><?php echo e(\Carbon\Carbon::parse($prenotazione->partenza)->format('d/m/Y')); ?></p>
                                                    <p><?php echo e($prenotazione->numAdulti); ?></p>
                                                    <p><?php echo e($prenotazione->numBambini); ?></p>
                                                    <p>€<?php echo e($prenotazione->prezzoTotale); ?></p>
                                                    <p><?php echo e($prenotazione->email); ?></p>
                                                    <p><?php echo e($prenotazione->telefono); ?></p>
                                                    <p><?php echo e($prenotazione->stato); ?></p>
                                                    <p><?php echo e(\Carbon\Carbon::parse($prenotazione->orarioArrivo)->format('H:i')); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card di conferma cancellazione -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-4 mt-md-0 card-conferma-eliminazione">
                                    <div class="card border-secondary card-custom-width">
                                        <div class="card-header text-center ">
                                            Conferma
                                        </div>
                                        <div class="card-body text-center">
                                            <p>
                                                <?php echo e(trans('messages.prenotazione')); ?> <strong><?php echo e(trans('messages.cancellata')); ?></strong>
                                            </p>
                                            <form name="prenotazione" method="post" action="<?php echo e(route('prenotazioniAdmin.destroy', ['prenotazioniAdmin' => $prenotazione->id])); ?>" style="padding: 0.80em;">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                                <label for="mySubmit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> <?php echo e(trans('button.elimina')); ?></label>
                                                <input id="mySubmit" class="d-none" type="submit" value="Delete">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card per annullare la cancellazione -->
                                <div class="col-md-4 mt-md-0 card-conferma-eliminazione">
                                    <div class="card border-secondary card-custom-width">
                                        <div class="card-header text-center">
                                            Annulla
                                        </div>
                                        <div class="card-body text-center">
                                            <p>
                                                <?php echo e(trans('messages.prenotazione')); ?> <strong><?php echo e(trans('messages.nonCancellata')); ?></strong>
                                            </p>
                                            <a class="btn btn-secondary w-100" href="<?php echo e(route('prenotazioniAdmin.index')); ?>"><i class="bi bi-box-arrow-left"></i> <?php echo e(trans('button.annulla')); ?></a>
                                        </div>
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

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/adminPrenotazioni/deletePrenotazione.blade.php ENDPATH**/ ?>