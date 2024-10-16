

<!-- <td><?php echo e($prenotazione->arrivo); ?></td>
                        <td><?php echo e($prenotazione->partenza); ?></td>
                        <td><?php echo e($prenotazione->numAdulti); ?></td>
                        <td><?php echo e($prenotazione->numBambini); ?></td>
                        <td><?php echo e($prenotazione->prezzoTotale); ?></td>
                        <td><?php echo e($prenotazione->nome); ?></td>
                        <td><?php echo e($prenotazione->cognome); ?></td>
                        <td><?php echo e($prenotazione->orarioArrivo); ?></td> -->
<?php $__env->startSection('titolo'); ?>
Dettagli Prenotazione
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniAdmin','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('prenotazioniAdmin.index')); ?>">Prenotazioni Admin</a></li>
<li class="breadcrumb-item active" aria-current="page">Dettagli prenotazione</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<div class="container-fluid mb-3 pt-3">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <h1>Dettagli prenotazione:</h1>
        </div>
    </div>
</div>

<div class="container-fluid px-lg-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Arrivo:</b>
                </div>
                <div class="col-md-8">
                    <?php echo e($prenotazione->arrivo); ?>

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Partenza:</b>
                </div>
                <div class="col-md-8">
                    <?php echo e($prenotazione->partenza); ?>

                </div>
            </div>

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
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Prezzo:</b>
                </div>
                <div class="col-md-8">
                    €<?php echo e($prenotazione->prezzoTotale); ?>

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
                    <b>Stato:</b>
                </div>
                <div class="col-md-8">
                    <?php echo e($prenotazione->stato); ?>

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <b>Orario Arrivo:</b>
                </div>
                <div class="col-md-8">
                    <?php echo e($prenotazione->orarioArrivo); ?>

                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="row mb-3">
                <div class="col-md-12">
                    <a class="btn btn-primary w-100" href="<?php echo e(route('prenotazioniAdmin.edit', ['prenotazioniAdmin' => $prenotazione->id])); ?>"><i class="bi bi-pencil-square"></i> Modifica</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <a class="btn btn-danger w-100" href="<?php echo e(route('prenotazioniAdmin.destroy.confirm', ['id' => $prenotazione->id])); ?>"><i class="bi bi-trash"></i> Elimina</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <a class="btn btn-secondary w-100" href="<?php echo e(url()->previous()); ?>"><i class="bi bi-box-arrow-left"></i> Annulla</a>
                </div>
            </div>
        </div>
    </div>    
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/adminPrenotazioni/detailsPrenotazione.blade.php ENDPATH**/ ?>