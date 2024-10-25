

<?php $__env->startSection('titolo'); ?>
Zenzero Holidays
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_home','active'); ?>

<?php $__env->startSection('corpo'); ?>
    <section id="topHome">
      <!--Carosello di foto-->
      <div class="container-fluid" id="caroselloHome">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <!--Trattini per la navigazione-->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
            </div>
            <!--Slides-->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./img/sirmione-hd.jpg" class="d-block w-100" alt="...">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="carousel-caption text-center">
                        <h3>Zenzero Holidays!</h3>
                        <p><?php echo e(trans('messages.carosello')); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./img/gardaland-4517784_1280.jpg" class="d-block w-100" alt="..."><!--OK-->
                <div class="row">
                  <div class="col-xl-12">
                      <div class="carousel-caption text-center">
                          <h3>Zenzero Holidays!</h3>
                          <p><?php echo e(trans('messages.carosello')); ?></p>
                      </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./img/peakpx.jpg" class="d-block w-100" alt="...">
                <div class="row">
                  <div class="col-xl-12">
                      <div class="carousel-caption text-center">
                          <h3>Zenzero Holidays!</h3>
                          <p><?php echo e(trans('messages.carosello')); ?></p>
                      </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./img/Larici.jpg" class="d-block w-100" alt="...">
                <div class="row">
                  <div class="col-xl-12">
                      <div class="carousel-caption text-center">
                          <h3>Zenzero Holidays!</h3>
                          <p><?php echo e(trans('messages.carosello')); ?></p>
                      </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./img/gardaSVigilio.jpg" class="d-block w-100" alt="..."><!--OK-->
                <div class="row">
                  <div class="col-xl-12">
                      <div class="carousel-caption text-center">
                          <h3>Zenzero Holidays!</h3>
                          <p><?php echo e(trans('messages.carosello')); ?></p>
                      </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./img/LagoAlto.jpg" class="d-block w-100" alt="...">
                <div class="row">
                  <div class="col-xl-12">
                      <div class="carousel-caption text-center">
                          <h3>Zenzero Holidays!</h3>
                          <p><?php echo e(trans('messages.carosello')); ?></p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Freccette di navigazione -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
      

         <!-- Bottone "Prenota Ora" sovrapposto al carosello -->
         <div class="position-absolute top-50 start-50 translate-middle">
          <a class="btn btn-prenota btn-lg" href="<?php echo e(route('calendario')); ?>"><?php echo e(trans('button.book')); ?></a>
        </div>
      </div>
    </section>

    <section id="titoloHome">
      <div class="container text-center" id="titolo"> <!--Inserire gli elementi in un container me li rende responsive e crea i margini-->
          <!--my-5 aggiunge un margine verticale maggiore al container, attributi trovati su bootstrap:utilities->spacing -->
          <!-- text-center classe per metter gli elementi al centro del container, trovata in utilities->text-->
          <!--maxwidth è un attributo css per far sì che non si allarghi mai più di 580px-->
          <h1><?php echo e(trans('messages.titoloHome')); ?></h1>
          <p class="lead">
            <?php echo e(trans('messages.testoHome')); ?>

          </p>
      
          <a href="<?php echo e(route('contatti')); ?>" class="btn btn-custom"><?php echo e(trans('button.contact')); ?></a>
      </div>
    </section>

    <section id="cardsHome">
      <!--Container contenente le cards per le info e i luoghi d'interesse-->
      <!--All'interno creata una grid con una riga e due colonne per allineare le cards (bootstrap:layout->grid)-->
      <!--"-sm" è un breakpoint (layout->breakpoints) small, serve a modificare quanto posso stringere prima che l'altra cards vada sotto-->
      <div class="container text-center ">
            <div class="row ">
                <div class="col-sm ">
                    <div class="card card-custom mx-auto border-0 my-2">
                        <img src="./img/ZenBalcone.jpg" class="card-img-top" alt="Vista del balcone della casa vacanze">
                        <!--alt dà descrizione foto per motivi di accessibilità, visualizzata in caso di errori di caricamentto img e ottimizzazione motori di ricerca-->
                        <div class="card-body">
                            <p class="card-text lead"><?php echo e(trans('messages.card1')); ?></p>
                            <a href="<?php echo e(route('casaVacanze')); ?>" class="btn btn-custom">Zenzero Holidays</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card card-custom mx-auto border-0 my-2">
                        <img src="./img/Gardaland2.png" class="card-img-top" alt="Logo di Gardaland">
                        <div class="card-body">
                            <p class="card-text lead"><?php echo e(trans('messages.card2')); ?></p>
                            <a href="<?php echo e(route('luoghiDiInteresse')); ?>" class="btn btn-custom"><?php echo e(trans('button.luoghi')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="mapHome">
      <!--Google Maps Position-->
      <div class="container ">
          <h5><?php echo e(trans('messages.position')); ?></h5>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25059.927593339075!2d10.70870480773605!3d45.43549803298717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4781e9abaa989e9d%3A0x1a81cd6ab0fb3127!2sVia%20Mantovana%2C%2058d%2C%2037014%20Cavalcaselle%20VR!5e0!3m2!1sit!2sit!4v1710252577943!5m2!1sit!2sit" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </section>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/index.blade.php ENDPATH**/ ?>