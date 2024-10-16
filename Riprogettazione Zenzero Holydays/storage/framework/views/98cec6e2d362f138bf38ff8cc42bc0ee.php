

<?php $__env->startSection('titolo'); ?>
<?php echo e(trans('button.luoghi')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_luoghi','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('button.luoghi')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>

        
        <div class="li-container">
            <div class="carousel-caption">
                <h3><?php echo e(trans('button.luoghi')); ?></h3>
            </div>
        </div>

        <section id="descrizione" class="px-lg-4">
            <div class="container">
                <h1 class="text-center mb-3"><?php echo e(trans('button.luoghi')); ?></h1>
                <div class="row">
                    <div class="col-md-6">
                        <h2><?php echo e(trans('messages.parchi')); ?></h2>
                        <ul>
                            <li>Gardaland - <?php echo e(trans('messages.distanza')); ?>: 3 km</li>
                            <li>Caneva Aquapark - <?php echo e(trans('messages.distanza')); ?>: 5 km</li>
                            <li>Movieland - <?php echo e(trans('messages.distanza')); ?>: 5 km</li>
                            <li>Medieval Times (ristorante con spetttacolo) - <?php echo e(trans('messages.distanza')); ?>: 5 km</li>
                            <li>Parco Giardino Sigurtà - <?php echo e(trans('messages.distanza')); ?>:  km</li>
                            <li>Parco Natura Viva (zoo e safari) - <?php echo e(trans('messages.distanza')); ?>:  km</li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2><?php echo e(trans('messages.citta')); ?></h2>
                        <ul>
                            <li>Peschiera del Garda - <?php echo e(trans('messages.distanza')); ?>: 2 km</li>
                            <li>Lazise - <?php echo e(trans('messages.distanza')); ?>: 6 km</li>
                            <li>Sirmione - <?php echo e(trans('messages.distanza')); ?>: 8 km</li>
                            <li>Bardolino - <?php echo e(trans('messages.distanza')); ?>:  km</li>
                            <li>Garda - <?php echo e(trans('messages.distanza')); ?>:  km</li>
                            <li>Borghetto - <?php echo e(trans('messages.distanza')); ?>:  km</li>
                            <li>Desenzano del Garda - <?php echo e(trans('messages.distanza')); ?>: km</li>
                            <li>Verona - <?php echo e(trans('messages.distanza')); ?>:  km</li>
                            <li>Mantova - <?php echo e(trans('messages.distanza')); ?>:  km</li>



                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h2><?php echo e(trans('messages.terme')); ?></h2>
                        <ul>
                            <li>Terme di Sirmione - <?php echo e(trans('messages.distanza')); ?>: 7 km</li>
                            <li>Parco termale del Garda - <?php echo e(trans('messages.distanza')); ?>: 4 km</li>
                            <li>Aquardens - <?php echo e(trans('messages.distanza')); ?>:  km</li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2>Sport</h2>
                        <ul>
                            <li><?php echo e(trans('messages.pesca')); ?> - <?php echo e(trans('messages.distanza')); ?>: 1 km</li>
                            <li>Golf Club Paradiso - <?php echo e(trans('messages.distanza')); ?>: 4 km</li>
                            <li>Sup Experience Garda Lake - <?php echo e(trans('messages.distanza')); ?>: 2 km</li>
                            <li><?php echo e(trans('messages.funivia')); ?>- <?php echo e(trans('messages.distanza')); ?>: 45 km</li>
                            <li><?php echo e(trans('messages.ferrata')); ?> - <?php echo e(trans('messages.distanza')); ?>: 60 km</li>



                        </ul>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/pages/luoghiDiInteresse.blade.php ENDPATH**/ ?>