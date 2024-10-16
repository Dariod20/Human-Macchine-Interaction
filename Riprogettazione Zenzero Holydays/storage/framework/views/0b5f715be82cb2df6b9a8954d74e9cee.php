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
    $(document).ready(function(){
        // Searching feature
        $(".searchOptions").on("click", function(e) {
            e.preventDefault();
            var column = $(this).attr("data-column");
            $("#searchInput").attr("data-column", column);
            $("#searchInput").attr("placeholder", "Cerca per " + $(this).text().toLowerCase() + "...");
            $("#searchInput").trigger("keyup"); // Riesegui la ricerca quando viene selezionata una colonna
        });

        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            // Reimposta completamente la paginazione se il campo di ricerca viene svuotato
            if (value !== "") {
                $("#paginationNav").hide();
            } else {
                $("#paginationNav").show();
                currentPage = 1; // Riporta alla prima pagina
                showPage(currentPage);
                return;
            }
            
            var column = $("#searchInput").attr("data-column");

            $("#bookTable tbody tr").each(function() {
                var found = false;
                if ((column == -1)||(column === undefined)) { // Selezionato "Title or author" o nessuna opzione
                    $(this).find("td").slice(0, -1).each(function() { // Escludi l'ultima colonna
                        var text = $(this).text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    });
                } else {
                    var $td = $(this).find("td:eq(" + column + ")");
                    if ($td.length > 0) {
                        var text = $td.text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    }
                }
                $(this).toggle(found);
            });
        });
    });
</script>

<div class="container-fluid mb-3 pt-3 text-center">
    <h1>
        Lista tariffe
    </h1>
</div>




<div class="container-fluid px-lg-4 mt-4">
    <div class="row pt-3 mb-3">
        <div class="col-md-6 d-flex align-items-center">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Cerca per</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item searchOptions" href="#" data-column="0">Giorno</a></li>
                        <li><a class="dropdown-item searchOptions" href="#" data-column="1">Prezzo</a></li>
                        <li><a class="dropdown-item searchOptions" href="#" data-column="-1">Giorno o prezzo</a></li>
                    </ul>
                </div>
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" placeholder="Cerca...">
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <a class="btn btn-primary me-2" href="<?php echo e(route('tariffeAdmin.editGruppo')); ?>"><i class="bi bi-pencil-square"></i> Modifica gruppo di tariffe</a>
            <a class="btn btn-success " href="<?php echo e(route('tariffeAdmin.create')); ?>">
                <i class="bi bi-database-add"></i> 
                Crea nuova tariffa
            </a>
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
                <table id="bookTable" class="table table-striped table-hover">
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
                                <td><?php echo e($tariffa->giorno); ?></td>
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/adminTariffe/tariffe.blade.php ENDPATH**/ ?>