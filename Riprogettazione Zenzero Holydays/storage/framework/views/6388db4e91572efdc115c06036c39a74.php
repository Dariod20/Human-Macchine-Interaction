

<?php $__env->startSection('titolo'); ?>
Prenotazioni
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioni','active'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Prenotazioni</li>
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('corpo'); ?>
<script>
    $(document).ready(function(){
        
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
            

            $("#bookTable tbody tr").each(function() {
                var found = false;
                
                $(this).find("td").slice(0, -3).each(function() { // Escludi le ultime tre colonne
                    var text = $(this).text().toLowerCase();
                    if (text.indexOf(value) > -1) {
                        found = true;
                    }
                });
                
                $(this).toggle(found);
            });
        });
    });
</script>
<div class="container-fluid mb-3 pt-3">
        <h1>
            Lista prenotazioni
        </h1>
</div>

<div class="container-fluid px-lg-4 mt-4">

    <div class="row mb-3 pt-3">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" placeholder="Cerca prenotazione...">
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center">
            <a class="btn btn-success" href="<?php echo e(route('prenotazioniAdmin.create')); ?>">
                <i class="bi bi-database-add"></i> 
                Crea nuova prenotazione
            </a>
        </div>
    </div>

    <nav aria-label="Page navigation example" id="paginationNav">
        <ul class="pagination justify-content-center">
            <li class="page-item" id="previousPage"><a class="page-link" href="#">Precedente</a></li>
            <!-- Numeri di pagina -->
            <li class="page-item" id="nextPage"><a class="page-link" href="#">Prossima</a></li>
            <li>
                <select id="rowsPerPage" class="form-control justify-content-end">
                    <option value="5">5 prenotazioni per pagina</option>
                    <option value="10">10 prenotazioni per pagina</option>
                    <option value="15">15 prenotazioni per pagina</option>
                    <option value="20">20 prenotazioni per pagina</option>
                </select>
            </li>
        </ul>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <table id="bookTable" class="table table-striped table-hover table-responsive">
                <col width='20%'>
                <col width='20%'>
                <col width='15%'>
                <col width='15%'>
                <col width='10%'>
                <col width='10%'>
                <col width='10%'>

                <thead>
                    <tr>
                        <th>Arrrivo</th>
                        <th>Partenza</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php $__currentLoopData = $prenotazioni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prenotazione): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr> <!-- $arrivo,$partenza,$numAdulti,$numBambini,$prezzoTotale,$nome,$cognome,$email,$telefono,$stato,$orarioArrivo -->
                            <td><?php echo e($prenotazione->arrivo); ?></td>
                            <td><?php echo e($prenotazione->partenza); ?></td>
                            <td><?php echo e($prenotazione->nome); ?></td>
                            <td><?php echo e($prenotazione->cognome); ?></td>                     
                            
                            <td>
                                <a class="btn btn-secondary" href="<?php echo e(route('prenotazioniAdmin.show', ['prenotazioniAdmin' => $prenotazione->id])); ?>"> Dettagli</a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo e(route('prenotazioniAdmin.edit', ['prenotazioniAdmin' => $prenotazione->id])); ?>"><i class="bi bi-pencil-square"></i> Modifica</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="<?php echo e(route('prenotazioniAdmin.destroy.confirm', ['id' => $prenotazione->id])); ?>"><i class="bi bi-trash"></i> Elimina</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/admin/prenotazioni.blade.php ENDPATH**/ ?>