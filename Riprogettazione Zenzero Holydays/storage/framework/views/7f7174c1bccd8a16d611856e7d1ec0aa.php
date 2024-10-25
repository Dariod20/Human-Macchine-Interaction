 <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

<?php $__env->startSection('titolo','Errore'); ?>

<?php $__env->startSection('active_home','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-danger">
                <div class='card-header'>
                    <b>Accesso alla pagina non consentito:</b> qualcosa di errato è accaduto durante l'accesso a questa pagina!
                </div>
                <div class='card-body'>
                    <p><?php echo $message; ?></p>
                    <p><a class="btn btn-danger" href="<?php echo e(route('home')); ?>"><i class="bi bi-box-arrow-left"></i>Torna alla home!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/errors/404.blade.php ENDPATH**/ ?>