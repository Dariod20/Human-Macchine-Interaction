

<?php $__env->startSection('titolo'); ?>
<?php echo e(trans('button.casa')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_casa','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('button.casa')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
        <!-- Intestazione -->
        <!-- Sezione immagine di sfondo con testo -->
        <div class="bg-container">
            <div class="carousel-caption">
                <h3><?php echo e(trans('button.casa')); ?></h3>
            </div>
        </div>

            
       

        <!-- Descrizione -->
        <section id="descrizione" class="px-lg-4">
            <div class="container">
                <h2 class="text-center mb-4" id="titolo"><?php echo e(trans('messages.titoloCasa')); ?></h2>
                <p class="lead">
                <?php echo e(trans('messages.testoCasa')); ?>

                </p>
            </div>
        </section>

        <section id="descrizione2" class="px-lg-4">
            <div class="container">
                <h2 class="text-center mb-4" id="titolo"><?php echo e(trans('messages.titolo2Casa')); ?></h2>
                <p class="lead">
                    <?php echo e(trans('messages.descrizioneCasa')); ?>

                </p>
            </div>
        </section>

        <section id="gallery" class="px-lg-4">
            <div class="container px-lg-4 " >
                <h2 class="text-center mb-4" id="titolo"><?php echo e(trans('messages.galleria')); ?></h2>

                <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel">

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img src="./img/zen12.jpg" class="w-100">
                        </div>

                        <div class="carousel-item " 
                        data-bs-interval="2000">
                            <img src="./img/ZenCucina.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                            <img src="./img/zen13.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen1.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen2.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen3.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen4.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen5.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen6.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen7.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen8.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen9.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen10.jpg" class="w-100">
                        </div>

                        <div class="carousel-item ">
                                <img src="./img/zen11.jpg" class="w-100">
                        </div>

                    </div>

                    <button class="carousel-control-prev" 
                        type="button"
                        data-bs-target="#carouselDemo" 
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselDemo"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/pages/casaVacanze.blade.php ENDPATH**/ ?>