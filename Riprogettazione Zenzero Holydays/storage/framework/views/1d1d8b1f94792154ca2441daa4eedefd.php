

<?php $__env->startSection('titolo'); ?>
Conferma Prenotazione
<?php $__env->stopSection(); ?>

<?php $__env->startSection('left_navbar'); ?>
            <li class="nav-item">
              <a class="nav-link active me-2" aria-current="page" href="<?php echo e(route('home')); ?>">Home</a> <!--me-2 allarga i margini-->
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="<?php echo e(route('casaVacanze')); ?>">La casa vacanze</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="<?php echo e(route('luoghiDiInteresse')); ?>">Luoghi d'interesse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="#">Contattaci</a>
            </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>

        <div class="container-fluid px-lg-4 mt-4">
            
            <!-- Calcola la durata del soggiorno -->
           <!--  ?php
                        $arrivo = new DateTime($_POST['dataArrivo']);
                        $partenza = new DateTime($_POST['dataPartenza']);
                        $durata = $arrivo->diff($partenza)->days;
            ?>
             -->
            <div class="row">
                <!-- Scheda riassuntiva -->
                <div class="col-md-4">
                    <div class="summary-card">
                        <h5>Riepilogo Prenotazione</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Data di Arrivo: <?php echo e($arrivo); ?><strong> <!-- ?php echo $_POST['dataArrivo']; ?></strong></li> -->
                            <li class="list-group-item">Data di Partenza: <?php echo e($partenza); ?><strong> <!--?php echo $_POST['dataPartenza']; ?></strong></li>-->
                            <li class="list-group-item">Durata Soggiorno: <?php echo e($numGiorni); ?><strong><strong> <!--?php echo $durata; ?> notti</strong></li>-->
                            <li class="list-group-item">Numero di Adulti: <?php echo e($numAdulti); ?><strong> <!--?php echo $_POST['numAdulti']; ?></strong></li>-->
                            <li class="list-group-item">Numero di Bambini: <?php echo e($numBambini); ?><strong> <!--?php echo $_POST['numBambini']; ?></strong></li>-->
                        </ul>
                    </div>
<!--                     with('costoTotale', $costoTotale)->with('tassaSoggiorno', $tassaSoggiorno); -->
                    <div class="total-section mt-3">
                        <h3><strong>Totale: €<?php echo e($costoTotale); ?></strong></h3> <!-- INSERISCI totale calcolato su numero notti e giorni inseriti -->
                    </div>
                    <div class="price-info mt-3">
                        <h5>Informazioni sul prezzo</h5>
                        <p>Il prezzo non include la tassa di soggiorno che dovrà essere versata in contanti all'arrivo.</p>
                        <p class="d-flex justify-content-between">
                            <span class="price-label">Tassa di soggiorno:</span>
                            <span>€<?php echo e($tassaSoggiorno); ?></span> <!-- INSERISCI tassa di soggiorno calcolata su numero di adulti inseriti -->
                        </p>
                    </div>
                </div>

                <!-- Form container -->
                <div class="col-md-8 form-container">
                    <h2>Conferma Prenotazione</h2>
                    <form name="prenotazione" method="post" action="<?php echo e(route('prenotazione.store', ['arrivo' => $arrivo, 'partenza' => $partenza, 'numAdulti' => $numAdulti, 'numBambini' => $numBambini, 'prezzoTotale' => $costoTotale ])); ?>">
                    <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cognome">Cognome</label>
                            <input type="text" class="form-control" id="cognome" name="cognome" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Indirizzo Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="stato">Stato di Provenienza</label>
                            <select class="form-control" id="stato" name="stato">
                                <option value="italia">Italia</option>
                                <option value="francia">Francia</option>
                                <option value="germania">Germania</option>
                                <!-- Aggiungi altre opzioni secondo necessità -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Numero di Telefono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="orarioArrivo">Orario di Arrivo Previsto</label>
                            <input type="time" class="form-control" id="orarioArrivo" name="orarioArrivo" required>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Conferma Prenotazione</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Save"/>
                        </div>
<!--                             <button type="submit" class="btn btn-primary mt-auto">Conferma Prenotazione</button>-->                 
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/confermaPrenotazione.blade.php ENDPATH**/ ?>