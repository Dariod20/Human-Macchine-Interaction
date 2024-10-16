

<?php $__env->startSection('titolo'); ?>
La casa Vacanze
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_casa','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Casa Vacanze</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
        <!-- Intestazione -->
        
            
        <header class="vacation-header">
            <h1>La Casa Vacanze</h1>
        </header>

        <!-- Descrizione -->
        <section id="descrizione" class="px-lg-4 mt-4">
            <div class="container">
                <h2 class="text-center mb-4" id="titolo">Benvenuti alla Casa Vacanze Zenzero Holidays</h2>
                <p class="lead">
                    La nostra casa vacanze è il luogo perfetto per trascorrere le vostre vacanze sul lago di Garda.
                    Situata in una piccola frazione a 2km da Peschiera del Garda, la Casa Vacanze Zenzero Holidays vi accoglie 
                    con il calore e l'ospitalità tipici di una struttura a conduzione familiare.
                    Strategicamente posizionata a pochi minuti dal rinomato parco divertimenti Gardaland e nelle vicinanze delle 
                    incantevoli località di Peschiera, Lazise e Sirmione, la nostra casa vacanze offre un punto di partenza ideale per esplorare le meraviglie del lago di Garda.
                </p>
            </div>
        </section>

        <section id="descrizione2" class="px-lg-4 mt-4">
            <div class="container">
                <h2 class="text-center mb-4" id="titolo">L'appartamento</h2>
                <p class="lead">
                    Con un ingresso condiviso con solo un'altra abitazione e la disponibilità di parcheggio coperto e privato su richiesta, vi assicuriamo tranquillità e privacy durante il vostro soggiorno.
                    L'ampio soggiorno è dotato di aria condizionata e la cucina è completamente attrezzata con forno e microonde. Con due bagni, di cui uno con doccia e uno con vasca e lavatrice, e una camera da letto con aria condizionata, 
                    troverete tutto ciò di cui avete bisogno per un soggiorno indimenticabile. È inoltre presente un balcone con tavolino e sedie. 
                    Nella piazzetta proprio sotto la struttura puoi trovare un bar dove fare colazione e un negozio di parrucchiere. In centro paese (300 metri) troverai market, panificio, bar, pub, ristorante, pizzeria, farmacia, 
                    erboristeria, la chiesa, banca e negozi vari, abbigliamento, merceria, articoli regalo.
                </p>
            </div>
        </section>

        <div class="container px-lg-4 mt-4">
            <h2 class="text-center mb-4" id="titolo">Sfoglia la gallery</h2>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/casaVacanze.blade.php ENDPATH**/ ?>