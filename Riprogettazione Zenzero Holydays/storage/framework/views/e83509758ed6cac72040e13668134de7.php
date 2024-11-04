


<?php $__env->startSection('titolo'); ?>
Dettagli Prenotazione
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioni','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('tariffeAdmin.index')); ?>">Tariffe</a></li>
<li class="breadcrumb-item active" aria-current="page">Dettagli tariffa</li>
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
                                <h1>Dettagli Tariffa:</h1>
                            </div>
                        </div>
                    </div>

                    <div id="inner">
                        <div class="container-fluid px-lg-4 mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <b>Giorno:</b>
                                        </div>
                                        <div class="col-md-8">
                                            <?php echo e(\Carbon\Carbon::parse($tariffa->giorno)->format('d/m/Y')); ?>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <b>Prezzo:</b>
                                        </div>
                                        <div class="col-md-8">
                                            <?php echo e($tariffa->prezzo); ?>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <b>Ospite:</b>
                                        </div>
                                        <?php if(isset($tariffa->prenotazione_id)): ?>
                                            <div class="col-md-8">
                                                <?php echo e($tariffa->prenotazione->nome); ?> <?php echo e($tariffa->prenotazione->cognome); ?>

                                            </div>
                                        <?php else: ?>
                                            <div class="col-md-8">Libero</div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <?php if(!isset($tariffa->prenotazione_id)): ?>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a class="btn btn-primary w-100" href="<?php echo e(route('tariffeAdmin.edit', ['tariffeAdmin' => $tariffa->id])); ?>"><i class="bi bi-pencil-square"></i> Modifica</a>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a class="btn btn-danger w-100" href="<?php echo e(route('tariffeAdmin.destroy.confirm', ['id' => $tariffa->id])); ?>"><i class="bi bi-trash"></i> Elimina</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a class="btn btn-secondary w-100" href="<?php echo e(url()->previous()); ?>"><i class="bi bi-box-arrow-left"></i> Annulla</a>
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/adminTariffe/detailsTariffa.blade.php ENDPATH**/ ?>