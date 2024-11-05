 

<?php $__env->startSection('titolo'); ?>
    Elimina Tariffa
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_tariffeAdmin','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('tariffeAdmin.index')); ?>">Tariffe</a></li>
<li class="breadcrumb-item active" aria-current="page">Elimina tariffa</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('corpo'); ?>

<?php
    $lang = app()->getLocale();
    $dateFormat = $lang === 'it' ? 'd/m/Y' : 'Y/m/d'; // Imposta il formato della data in base alla lingua
?>

<section id="form-admin">
    <div class="container-fluid px-lg-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">

                    <div class="container-fluid mt-4" style="padding: inherit;">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <h2>
                                    Stai per cancellare la tariffa per il giorno <?php echo e(\Carbon\Carbon::parse($tariffa->giorno)->format($dateFormat)); ?> dalla lista.
                                </h2>
                                
                            </div>
                        </div>

                        <div id="inner">

                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="card border-secondary">
                                        <div class="card-header text-center">
                                            Conferma
                                        </div>
                                        <div class="card-body text-center">
                                            <p>
                                                La tariffa <strong>sarà rimossa permanentemente</strong> dal database.
                                            </p>
                                            <ul class="list-unstyled">
                                                <li><strong>Giorno:</strong> <?php echo e(\Carbon\Carbon::parse($tariffa->giorno)->format($dateFormat)); ?></li>
                                                <li><strong>Prezzo:</strong> €<?php echo e($tariffa->prezzo); ?></li>
                                            </ul>
                                            <form name="tariffa" method="post" action="<?php echo e(route('tariffeAdmin.destroy', ['tariffeAdmin' => $tariffa->id])); ?>" style="padding: unset;">
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
                                                La tariffa <strong>non sarà rimossa permanentemente</strong> dal database.
                                            </p>
                                            <ul class="list-unstyled">
                                                <li><strong>Giorno:</strong> <?php echo e(\Carbon\Carbon::parse($tariffa->giorno)->format($dateFormat)); ?></li>
                                                <li><strong>Prezzo:</strong> €<?php echo e($tariffa->prezzo); ?></li>
                                            </ul>
                                            <a class="btn btn-secondary w-100" href="<?php echo e(route('tariffeAdmin.index')); ?>"><i class="bi bi-box-arrow-left"></i> Annulla</a>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/adminTariffe/deleteTariffa.blade.php ENDPATH**/ ?>