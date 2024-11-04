 <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

<?php $__env->startSection('title', 'Tariffe'); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('/')); ?>/js/paginationScript.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_tariffe','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Tariffe</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('corpo'); ?>
<script>
    $(document).ready(function() {
        var typingTimer; // Timer to delay the action
        var doneTypingInterval = 200; // Time in milliseconds after the last keystroke
        var currentPage = 1; // Set up search options

        // Set default search column to "giorno" (assicurati di avere l'attributo data-column corretto)
        var defaultColumn = 0; // Supponendo che la colonna "giorno" sia la prima (indice 0)
        $("#searchInput").attr("data-column", defaultColumn);
        $("#searchInput").attr("placeholder", "<?php echo e(trans('pagination.cercaData')); ?>");

        // Click event for search options
        $(".searchOptions").on("click", function(e) {
            e.preventDefault();
            var column = $(this).attr("data-column");
            $("#searchInput").attr("data-column", column);
            // Set placeholder based on selected column
            if (column === '0') { // Assuming '0' is for "giorno"
                $("#searchInput").attr("placeholder", "<?php echo e(__('pagination.cercaData')); ?>");
            } else if (column === '1') { // Assuming '1' is for "prezzo"
                $("#searchInput").attr("placeholder", "<?php echo e(__('pagination.cercaPrezzo')); ?>");
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

            // Reset pagination if the search field is cleared
            if (value !== "") {
                $("#paginationNav").hide();
            } else {
                $("#paginationNav").show();
                $("#bookTable tbody tr").show(); // Show all rows
                currentPage = 1; // Reset to the first page
                showPage(currentPage);

                $("#noResultsMessage").hide(); // Nascondi il messaggio
                return;
            }

            // Get selected column for filtering
            var column = $("#searchInput").attr("data-column");
            var anyVisible = false; // Variabile per tracciare se ci sono risultati

            $("#bookTable tbody tr").each(function() {
                var found = false;

                // Filtering based on selected column
                if (column !== undefined) { // If a specific column is selected
                    var $td = $(this).find("td:eq(" + column + ")");
                    if ($td.length > 0) {
                        var text = $td.text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    }
                }

                $(this).toggle(found); // Show or hide the row based on search result
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

<section id="form-admin">
    <div class="container-fluid px-lg-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">


                    <div class="container-fluid mb-3 pt-3 text-center">
                        <h1>
                            Lista tariffe
                        </h1>
                    </div>


                    <div id="inner">

                        <div class="container-fluid px-lg-4">

                            <div class="row justify-content-center">
                                <div class="col-md-8 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-primary me-2" href="<?php echo e(route('tariffeAdmin.editGruppo')); ?>" style="font-size: large;">
                                        <i class="bi bi-pencil-square"></i> Modifica gruppo di tariffe
                                    </a>
                                    <a class="btn btn-success" href="<?php echo e(route('tariffeAdmin.create')); ?>" style="font-size: large;">
                                        <i class="bi bi-database-add"></i> Aggiungi gruppo di tariffe
                                    </a>
                                </div>
                            </div>


                            <div class="row pt-3 mb-3 justify-content-center">
                                <div class="col-md-8 d-flex align-items-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Cerca per</button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item searchOptions" href="#" data-column="0">Giorno</a></li>
                                                <li><a class="dropdown-item searchOptions" href="#" data-column="1">Prezzo</a></li>
                                            </ul>
                                        </div>
                                        <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" >
                                        <span class="input-group-addon">
                                            <i class="bi bi-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <nav aria-label="Page navigation example" id="paginationNav">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item" id="previousPage"><a class="page-link" href="#">Precedente</a></li>
                                    <!-- Numeri di pagina -->
                                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                                    <li>
                                        <select id="rowsPerPage" class="form-control justify-content-end">
                                            <option value="5">5 tariffe per pagina</option>
                                            <option value="10">10 tariffe per pagina</option>
                                            <option value="15">15 tariffe per pagina</option>
                                            <option value="20">20 tariffe per pagina</option>
                                        </select>
                                    </li>
                                </ul>
                            </nav>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="bookTable" class="table table-striped">
                                            <colgroup>
                                                <col style="width: 40%;">
                                                <col style="width: 40%;">
                                                <col style="width: 20%;">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th>Giorno</th>
                                                    <th>Prezzo</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $tariffe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tariffa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e(\Carbon\Carbon::parse($tariffa->giorno)->format('d/m/Y')); ?></td>
                                                        <td>€<?php echo e($tariffa->prezzo); ?></td>
                                                        <td>
                                                            <div class="btn-group-vertical" role="group">
                                                                <a class="btn btn-secondary mb-1" href="<?php echo e(route('tariffeAdmin.show', ['tariffeAdmin' => $tariffa->id])); ?>">Dettagli</a>
                                                                <?php if($tariffa->prenotazione_id == null): ?>
                                                                    <a class="btn btn-primary mb-1" href="<?php echo e(route('tariffeAdmin.edit', ['tariffeAdmin' => $tariffa->id])); ?>"><i class="bi bi-pencil-square"></i> Modifica</a>
                                                                    <a class="btn btn-danger" href="<?php echo e(route('tariffeAdmin.destroy.confirm', ['id' => $tariffa->id])); ?>"><i class="bi bi-trash"></i> Elimina</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <p class="text-center" id="noResultsMessage" style="display: none;"><?php echo e(trans('messages.rateSearch')); ?></p>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/adminTariffe/tariffe.blade.php ENDPATH**/ ?>