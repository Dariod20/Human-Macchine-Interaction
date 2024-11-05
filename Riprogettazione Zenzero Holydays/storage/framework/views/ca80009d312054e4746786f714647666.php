


<?php $__env->startSection('titolo'); ?>
Dettagli Prenotazione
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniUtente', 'active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('prenotazioniUtente.index')); ?>">Prenotazioni</a></li>
<li class="breadcrumb-item active" aria-current="page">Dettagli prenotazione</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>

<section id="form-admin">
    <div class="container-fluid px-lg-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">
                    <div class="container-fluid mb-3 pt-3">
                        <div class="row justify-content-center">
                            <div class="col-md-10 text-center">
                                <h1>Dettagli prenotazione:</h1>
                            </div>
                        </div>
                    </div>
                    <div id="inner">
                        <div class="container-fluid px-lg-4 mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-10 ">
                                    <div class="row justify-content-between text-center">

                                        <div class="col-md-5" style="display: flex; flex-direction: column;align-items: center;">

                                            <!-- Dati della prenotazione -->
                                            <h4 class="mb-4">Dati della prenotazione</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Arrivo:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e(\Carbon\Carbon::parse($prenotazione->arrivo)->format('d/m/Y')); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Partenza:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e(\Carbon\Carbon::parse($prenotazione->partenza)->format('d/m/Y')); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Orario Arrivo:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e(\Carbon\Carbon::parse($prenotazione->orarioArrivo)->format('H:i')); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5" style="display: flex; flex-direction: column;align-items: center;">
                                            <h4 class="mb-4">Numero di ospiti</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Numero Adulti:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->numAdulti); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Numero Bambini:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->numBambini); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    
                                    <div class="row justify-content-center text-center">
                                        <div class="col-md-10" style="display: flex; flex-direction: column;align-items: center;">
                                            <!-- Dati personali -->
                                            <h4 class="mb-4">Dati personali</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Nome:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->nome); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Cognome:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->cognome); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>E-mail:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->email); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Telefono:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->telefono); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Stato:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo e($prenotazione->stato); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <b>Prezzo:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    €<?php echo e($prenotazione->prezzoTotale); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 justify-content-center text-center">

                                    <div class="col-md-8">
                                        <?php if(Carbon\Carbon::parse($prenotazione->arrivo)->isFuture() || Carbon\Carbon::parse($prenotazione->arrivo)->isToday()): ?>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <a class="btn btn-danger w-100"
                                                        href="<?php echo e(route('prenotazioniUtente.destroy.confirm', ['id' => $prenotazione->id])); ?>">
                                                        <i class="bi bi-trash"></i><?php echo e(trans('button.elimina')); ?></a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a class="btn btn-secondary w-100" href="<?php echo e(url()->previous()); ?>">
                                                    <i class="bi bi-box-arrow-left"></i><?php echo e(trans('button.annulla')); ?></a>
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
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/utentePrenotazioni/detailsPrenotazione.blade.php ENDPATH**/ ?>