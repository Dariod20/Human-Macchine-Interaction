 

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
    <div class="container-fluid px-lg-4 mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>
                    Stai per cancellare la prenotazione di "<?php echo e($prenotazione->nome); ?> <?php echo e($prenotazione->cognome); ?>" dalla lista.
                </h2>
                <p class="confirm">
                    Confermi?
                </p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-5">
                <div class="card border-secondary">
                    <div class="card-header text-center">
                        Conferma
                    </div>
                    <div class="card-body text-center">
                        <p>
                            La prenotazione <strong>sarà rimossa permanentemente</strong> dal database.
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Arrivo:</strong> <?php echo e($prenotazione->arrivo); ?></li>
                            <li><strong>Partenza:</strong> <?php echo e($prenotazione->partenza); ?></li>
                            <li><strong>Num. Adulti:</strong> <?php echo e($prenotazione->numAdulti); ?></li>
                            <li><strong>Num. Bambini:</strong> <?php echo e($prenotazione->numBambini); ?></li>
                            <li><strong>Prezzo Totale:</strong> €<?php echo e($prenotazione->prezzoTotale); ?></li>
                            <li><strong>Email:</strong> <?php echo e($prenotazione->email); ?></li>
                        </ul>
                        <form name="prenotazione" method="post" action="<?php echo e(route('prenotazioniAdmin.destroy', ['prenotazioniAdmin' => $prenotazione->id])); ?>">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <label for="mySubmit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> Elimina</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card border-secondary">
                    <div class="card-header text-center">
                        Annulla
                    </div>
                    <div class="card-body text-center">
                        <p>
                            La prenotazione <strong>non sarà rimossa</strong> dal database.
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Arrivo:</strong> <?php echo e($prenotazione->arrivo); ?></li>
                            <li><strong>Partenza:</strong> <?php echo e($prenotazione->partenza); ?></li>
                            <li><strong>Num. Adulti:</strong> <?php echo e($prenotazione->numAdulti); ?></li>
                            <li><strong>Num. Bambini:</strong> <?php echo e($prenotazione->numBambini); ?></li>
                            <li><strong>Prezzo Totale:</strong> €<?php echo e($prenotazione->prezzoTotale); ?></li>
                            <li><strong>Email:</strong> <?php echo e($prenotazione->email); ?></li>
                        </ul>
                        <a class="btn btn-secondary w-100" href="<?php echo e(route('prenotazioniAdmin.index')); ?>"><i class="bi bi-box-arrow-left"></i> Annulla</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/adminPrenotazioni/deletePrenotazione.blade.php ENDPATH**/ ?>