

<?php $__env->startSection('titolo'); ?>
Luoghi di interesse
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_luoghi','active'); ?>

 
<?php $__env->startSection('corpo'); ?>
        <header class="place-header">
            <h1>Luoghi d'interesse</h1>
        </header>

        <div class="container">
            <h1 class="text-center mt-4 mb-3">Luoghi d'interesse</h1>
            <div class="row">
                <div class="col-md-6">
                    <h2>Parchi Divertimento</h2>
                    <ul>
                        <li>Gardaland - Distanza: 3 km</li>
                        <li>Caneva Aquapark - Distanza: 5 km</li>
                        <li>Movieland - Distanza: 5 km</li>
                        <li>Medieval Times (ristorante con spetttacolo) - Distanza: 5 km</li>
                        <li>Parco Giardino Sigurtà - Distanza:  km</li>
                        <li>Parco Natura Viva (zoo e safari) - Distanza:  km</li>


                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Città</h2>
                    <ul>
                        <li>Peschiera del Garda - Distanza: 2 km</li>
                        <li>Lazise - Distanza: 6 km</li>
                        <li>Sirmione - Distanza: 8 km</li>
                        <li>Bardolino - Distanza:  km</li>
                        <li>Garda - Distanza:  km</li>
                        <li>Borghetto - Distanza:  km</li>
                        <li>Desenzano del Garda - Distanza: km</li>
                        <li>Verona - Distanza:  km</li>
                        <li>Mantova - Distanza:  km</li>



                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h2>Terme</h2>
                    <ul>
                        <li>Terme di Sirmione - Distanza: 7 km</li>
                        <li>Parco termale del Garda - Distanza: 4 km</li>
                        <li>Aquardens - Distanza:  km</li>


                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Sport</h2>
                    <ul>
                        <li>Pesca sul Lago di Garda - Distanza: 1 km</li>
                        <li>Golf Club Paradiso - Distanza: 4 km</li>
                        <li>Sup Experience Garda Lake - Distanza: 2 km</li>
                        <li>Funivia per il monte Baldo - Distanza: 45 km</li>
                        <li>Parco delle fucine (vie ferrate con noleggio imbrago) - Distanza: 60 km</li>



                    </ul>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/luoghiDiInteresse.blade.php ENDPATH**/ ?>