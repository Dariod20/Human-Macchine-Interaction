<?php $__env->startSection('titolo'); ?>
Prenotazioni
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('/')); ?>/js/paginationScript.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioniAdmin','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Prenotazioni</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<script>
    $(document).ready(function() {
    var typingTimer;
    var doneTypingInterval = 200;
    var currentPage = 1;

    // Set up search options
    var defaultColumn = 1; // Default per ospite
    $("#searchInput").attr("data-column", defaultColumn);
    $("#searchInput").attr("placeholder", "<?php echo e(__('pagination.cercaOspite')); ?>"); // Placeholder per la ricerca di ospite

    // Click event for search options
    $(".searchOptions").on("click", function(e) {
        e.preventDefault();
        var column = $(this).attr("data-column");
        $("#searchInput").attr("data-column", column);

        // Set placeholder based on selected column
        if (column === '0') {
            // "Data"
            $("#searchInput").attr("placeholder", "<?php echo e(__('pagination.cercaData')); ?>"); // Placeholder per la ricerca di data
        } else if (column === '1') {
            // "Ospite"
            $("#searchInput").attr("placeholder", "<?php echo e(__('pagination.cercaOspite')); ?>"); // Placeholder per la ricerca di ospite
        }

        $("#searchInput").trigger("keyup"); // Trigger search when a column is selected
    });

    // Keyup event with delay for search functionality
    $("#searchInput").on("keyup", function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval); // Start a new timer
    });

    // Keydown event to clear timer if the user is still typing
    $("#searchInput").on("keydown", function() {
        clearTimeout(typingTimer);
    });

    // Function to execute search after typing delay
    function doneTyping() {
        var value = $("#searchInput").val().toLowerCase();

        // Nascondi la paginazione se il campo di ricerca contiene testo
        if (value !== "") {
            $("#paginationNav").hide();
        } else {
            $("#paginationNav").show();
            $("#bookTable tbody tr").show(); // Mostra tutte le righe
            currentPage = 1; // Torna alla prima pagina
            showPage(currentPage);

            $("#noResultsMessage").hide(); // Nascondi il messaggio
            return;
        }

        // Colonna selezionata per il filtro
        var column = $("#searchInput").attr("data-column");
        var anyVisible = false; // Variabile per tracciare se ci sono risultati


        $("#bookTable tbody tr").each(function() {
            var found = false;

            // Filtra in base alla colonna selezionata
            if (column !== undefined) {
                if (column === '0') { // Colonne "Arrivo" e "Partenza"
                    var arrivoText = $(this).find("td:eq(0)").text().toLowerCase();
                    var partenzaText = $(this).find("td:eq(1)").text().toLowerCase();
                    if (arrivoText.indexOf(value) > -1 || partenzaText.indexOf(value) > -1) {
                        found = true;
                    }
                } else if (column === '1') { // Colonna "Ospite"
                    var ospiteText = $(this).find("td:eq(2)").text().toLowerCase();
                    if (ospiteText.indexOf(value) > -1) {
                        found = true;
                    }
                }
            }

            $(this).toggle(found); // Mostra o nasconde la riga in base al risultato della ricerca
            if (found) anyVisible = true; // Imposta a true se viene trovato un risultato

        });
        if (anyVisible) {
            $("#noResultsMessage").hide();
        } else {
            $("#noResultsMessage").show();
        }
    }

});
</script>


<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php
    $lang = app()->getLocale();
    $dateFormat = $lang === 'it' ? 'd/m/Y' : 'Y/m/d'; // Imposta il formato della data in base alla lingua
?>

<section id="form-admin">
    <div class="container-fluid px-lg-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">

                    <div class="container-fluid mb-3 pt-3 text-center">
                        <h1>
                            <?php echo e(trans('messages.lista_prenotazioni')); ?>

                        </h1>
                    </div>


                    <div id="inner">
                        <div class="container-fluid px-lg-4 mt-4">
                            <div class="row mb-3 justify-content-start">
                                <div class="col-md-8 d-flex align-items-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Cerca per</button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item searchOptions" href="#" data-column="0">Data</a></li>
                                                <li><a class="dropdown-item searchOptions" href="#" data-column="1">Ospite</a></li>
                                            </ul>
                                        </div>
                                        <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button">
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
                                                        <td><?php echo e($prenotazione->nome); ?> <?php echo e($prenotazione->cognome); ?></td>
                                                        <td>
                                                            <div class="btn-group-vertical" role="group">
                                                                <a class="btn btn-secondary mb-1" href="<?php echo e(route('prenotazioniAdmin.show', ['prenotazioniAdmin' => $prenotazione->id])); ?>">Dettagli</a>
                                                                <a class="btn btn-danger" href="<?php echo e(route('prenotazioniAdmin.destroy.confirm', ['id' => $prenotazione->id])); ?>"><i class="bi bi-trash"></i> Elimina</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <p class="text-center" id="noResultsMessage" style="display: none;"><?php echo e(trans('messages.prenSearch')); ?></p>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/adminPrenotazioni/prenotazioni.blade.php ENDPATH**/ ?>