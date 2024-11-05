<?php $__env->startSection('titolo'); ?>
<?php echo e(trans('button.prenotazioni')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('/')); ?>/js/paginationScript.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniUtente','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('button.prenotazioni')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<script>
     $(document).ready(function(){
        var typingTimer; // Timer per ritardare l'azione
        var doneTypingInterval = 200; // Tempo di attesa dopo l'ultimo tasto premuto (in millisecondi)
        var currentPage = 1;

        $("#searchInput").on("keyup", function() {
            clearTimeout(typingTimer); // Cancella il timer precedente
            typingTimer = setTimeout(doneTyping, doneTypingInterval); // Imposta un nuovo timer
        });


        function doneTyping() {
            var value = $("#searchInput").val().toLowerCase();

            if (value !== "") {
                $("#paginationNav").hide();
                var foundAny = false; // Variabile per tenere traccia se troviamo risultati

                $("#bookTable tbody tr").each(function() {
                    var found = false;
                    $(this).find("td").slice(0, 2).each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    });
                    $(this).toggle(found);
                    if (found) {
                        foundAny = true; // Se troviamo almeno un risultato, aggiorniamo la variabile
                    }
                });
                // Mostra o nascondi il messaggio "nessun risultato"
                if (!foundAny) {
                    $("#noResultsMessage").show(); // Mostra il messaggio se non ci sono risultati
                } else {
                    $("#noResultsMessage").hide(); // Nascondi il messaggio se ci sono risultati
                }
            } else {
                // Se il campo di ricerca è vuoto, mostra la paginazione e ripristina tutte le righe
                $("#paginationNav").show();
                $("#bookTable tbody tr").show();
                $("#noResultsMessage").hide(); // Nascondi il messaggio
                currentPage = 1;
                showPage(currentPage);
            }
        }

        // Funzione per gestire l'annullamento della digitazione quando il tasto è ancora premuto
        $("#searchInput").on("keydown", function() {
            clearTimeout(typingTimer);
        });
    });
</script>

<section id="form-admin">
    <div class="container-fluid px-lg-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">

                    <div class="container-fluid mb-3 pt-3 text-center">
                        <h1>
                            <?php echo e(trans('messages.prenIt')); ?><?php echo e(session('loggedName')); ?><?php echo e(trans('messages.prenEn')); ?>

                        </h1>
                    </div>

                    <div id="inner">
                        <div class="container-fluid px-lg-4">

                            <div class="row mb-3 pt-3 justify-content-start">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" placeholder="<?php echo e(trans('pagination.cercaData')); ?>">
                                        <span class="input-group-addon">
                                            <i class="bi bi-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex justify-content-end align-items-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownRowsPerPage"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(trans('button.visualizzazione')); ?> &nbsp&nbsp
                                        </button>
                                        <div class="dropdown-menu" id="menuPaginazione" aria-labelledby="dropdownRowsPerPage">
                                            <a class="dropdown-item" href="#" data-value="5">5 <?php echo e(trans('pagination.booking')); ?></a>
                                            <a class="dropdown-item" href="#" data-value="10">10 <?php echo e(trans('pagination.booking')); ?></a>
                                            <a class="dropdown-item" href="#" data-value="15">15 <?php echo e(trans('pagination.booking')); ?></a>
                                            <a class="dropdown-item" href="#" data-value="20">20 <?php echo e(trans('pagination.booking')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <nav aria-label="Page navigation example" id="paginationNav">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item" id="previousPage"><a class="page-link" href="#"> <?php echo e(trans('pagination.previous')); ?> </a></li>
                                    <li class="page-item" id="nextPage"><a class="page-link" href="#"> <?php echo e(trans('pagination.next')); ?> </a></li>
                                </ul>
                            </nav>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="bookTable" class="table table-striped">
                                            <colgroup>
                                                <col style="width: 25%;">
                                                <col style="width: 25%;">
                                                <col style="width: 25%;">
                                                <col style="width: 25%;">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(trans('messages.arrivo')); ?></th>
                                                    <th><?php echo e(trans('messages.partenza')); ?></th>
                                                    <th><?php echo e(trans('messages.prezzo')); ?></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $prenotazioni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prenotazione): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e(\Carbon\Carbon::parse($prenotazione->arrivo)->format('d/m/Y')); ?></td>
                                                        <td><?php echo e(\Carbon\Carbon::parse($prenotazione->partenza)->format('d/m/Y')); ?></td>
                                                        <td>€<?php echo e($prenotazione->prezzoTotale); ?></td>
                                                        <td>
                                                            <div class="btn-group-vertical" role="group">
                                                                <a class="btn btn-secondary mb-1" href="<?php echo e(route('prenotazioniUtente.show', ['prenotazioniUtente' => $prenotazione->id])); ?>"><?php echo e(trans('button.dettagli')); ?></a>
                                                                <?php if(Carbon\Carbon::parse($prenotazione->arrivo)->isFuture() || Carbon\Carbon::parse($prenotazione->arrivo)->isToday()): ?>
                                                                    <a class="btn btn-danger" href="<?php echo e(route('prenotazioniUtente.destroy.confirm', ['id' => $prenotazione->id])); ?>"><i class="bi bi-trash"></i> <?php echo e(trans('button.elimina')); ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/utentePrenotazioni/prenotazioniUtente.blade.php ENDPATH**/ ?>