<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $__env->yieldContent('titolo'); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--css-->
    <link href="<?php echo e(url('/')); ?>/css/style.css" rel="stylesheet"> <!-- nell'head va messo il collegamento al foglio di stile-->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/css/bootstrap.min.css">


    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

    <script src="<?php echo e(url('/')); ?>/js/bootstrap.bundle.min.js"></script>

    
    

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom jQuery and Javascript scripts -->
    <?php echo $__env->yieldContent('script'); ?>

  </head>

  <body class="bg-white">

    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="<?php echo e(route('home')); ?>">Zenzero Holidays</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
            <li class="nav-item">
              <a class="nav-link <?php echo $__env->yieldContent('active_home'); ?> me-2" aria-current="page" href="<?php echo e(route('home')); ?>">Home</a> <!--me-2 allarga i margini-->
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $__env->yieldContent('active_casa'); ?> me-2" href="<?php echo e(route('casaVacanze')); ?>"><?php echo e(trans('button.casa')); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $__env->yieldContent('active_luoghi'); ?> me-2" href="<?php echo e(route('luoghiDiInteresse')); ?>"><?php echo e(trans('button.luoghi')); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $__env->yieldContent('active_contatti'); ?> me-2" href="<?php echo e(route('contatti')); ?>"><?php echo e(trans('button.contact')); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $__env->yieldContent('active_prenota'); ?> me-2" href="<?php echo e(route('calendario')); ?>"><?php echo e(trans('button.book')); ?></a>
            </li>
            <?php if((session('logged')) && (session('role') == 'registered_user')): ?>
              <li class="nav-item">
                <a class="nav-link  <?php echo $__env->yieldContent('active_prenotazioniUtente'); ?> me-2" href="<?php echo e(route('prenotazioniUtente.index')); ?>"><?php echo e(trans('button.prenotazioni')); ?></a>
              </li>
            <?php elseif((session('logged')) && (session('role') == 'admin')): ?>
              <li class="nav-item">
                <a class="nav-link  <?php echo $__env->yieldContent('active_prenotazioniAdmin'); ?> me-2" href="<?php echo e(route('prenotazioniAdmin.index')); ?>"><?php echo e(trans('button.prenotazioni')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link  <?php echo $__env->yieldContent('active_tariffe'); ?> me-2" href="<?php echo e(route('tariffeAdmin.index')); ?>"><?php echo e(trans('button.tariffe')); ?></a>
              </li>  
            <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item"><a href="<?php echo e(route('setLang', ['lang' => 'en'])); ?>" class="nav-link"><img src="<?php echo e(url('/')); ?>/img/flags/en.png" width="20" alt="UK flag"/></a></li>
              <li class="nav-item"><a href="<?php echo e(route('setLang', ['lang' => 'it'])); ?>" class="nav-link"><img src="<?php echo e(url('/')); ?>/img/flags/it.png" width="16" alt="Italian flag"/></a></li>
              <?php if(session('logged')): ?>
                <li class="nav-item"><i><?php echo e(trans('messages.welcome')); ?> <?php echo e(session('loggedName')); ?></i> <a href="<?php echo e(route('user.logout')); ?>"><i class="bi bi-box-arrow-right"></i></a></li>
              <?php else: ?>
                <li class="nav-item"><a href="<?php echo e(route('user.login')); ?>"><i class="bi bi-person-check-fill"></i></a></li>
              <?php endif; ?>
            </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid d-flex justify-content-end">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <?php echo $__env->yieldContent('breadcrumb'); ?>
        </ol>
      </nav>
    </div>

    <div class="container-fluid ">
     
          <?php echo $__env->yieldContent('corpo'); ?>
        
    </div>
    
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white">
      <!-- Grid container -->
      <div class="container p-4 pb-0 footer">
        <!-- Section: Links -->
        <section>
          <!--Grid row-->
          <div class="row">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">Menù:</h6>
              <p><a class="text-white" href="<?php echo e(route('home')); ?>">Home</a></p>
              <p><a class="text-white" href="<?php echo e(route('casaVacanze')); ?>"><?php echo e(trans('button.casa')); ?></a></p>
              <p><a class="text-white" href="<?php echo e(route('luoghiDiInteresse')); ?>"><?php echo e(trans('button.luoghi')); ?></a></p>
              <p><a class="text-white" href="<?php echo e(route('contatti')); ?>"><?php echo e(trans('button.contact')); ?></a></p>
            </div>
            
            <hr class="w-100 clearfix d-md-none" />
            
            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold"><?php echo e(trans('messages.position')); ?>:</h6>
              <p><a href="https://maps.app.goo.gl/4W9M2on2tefVwz1a7" class="text-white">Via Mantovana, 58b, 37014 Cavalcaselle, VR, Italia</a></p>
            </div>
            
            <hr class="w-100 clearfix d-md-none" />
            
            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold"><?php echo e(trans('button.contact')); ?>:</h6>
              <p><a href="mailto:dina.colpani@gmail.com" class="text-white">dina.colpani@gmail.com</a></p>
              <p><a href="tel:+393334142902" class="text-white">+ 39 333 414 2902</a></p>
              <p><a href="tel:+393515869002" class="text-white">+ 39 351 586 9002</a></p>
            </div>
            
            <hr class="w-100 clearfix d-md-none" />
            
            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">Social:</h6>
              <!-- Facebook -->
              <p><a href="https://m.facebook.com/people/ZenZero-Holiday/100072790333341/">
              <i class="bi bi-facebook">Facebook</i>
        </a></p>
            </div>
            
            <hr class="w-100 clearfix d-md-none" />
            
          </div>
          <!--Grid row-->
        </section>
        <!-- Section: Links -->
      </div>
      <!-- Grid container -->
      
      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2024 Zenzero Holidays. All rights reserved.
      </div>
      <!-- Copyright -->
    </footer>
    

    
    
  </body>

</html><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/layouts/master.blade.php ENDPATH**/ ?>