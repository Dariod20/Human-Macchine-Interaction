

<?php $__env->startSection('titolo'); ?>
<?php echo e(trans('button.prenotazioni')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('/')); ?>/js/paginationScript.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active_prenotazioni','active'); ?>

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
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            if (value !== "") {
                $("#paginationNav").hide();
            } else {
                $("#paginationNav").show();
                currentPage = 1;
                showPage(currentPage);
                return;
            }
            $("#bookTable tbody tr").each(function() {
                var found = false;
                $(this).find("td").slice(0, -1).each(function() {
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
<div class="container-fluid mb-3 pt-3 text-center">
    <h1>
        <?php echo e(trans('messages.prenIt')); ?><?php echo e(session('loggedName')); ?><?php echo e(trans('messages.prenEn')); ?>

    </h1>
</div>

<div class="container-fluid px-lg-4 mt-4">
    <div class="row mb-3 pt-3">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" placeholder="<?php echo e(trans('pagination.cerca')); ?>">
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation example" id="paginationNav">
        <ul class="pagination justify-content-center">
            <li class="page-item" id="previousPage"><a class="page-link" href="#"><?php echo e(trans('pagination.previous')); ?></a></li>
            <li class="page-item" id="nextPage"><a class="page-link" href="#"><?php echo e(trans('pagination.next')); ?></a></li>
            <li>
                <select id="rowsPerPage" class="form-control justify-content-end">
                    <option value="5">5 <?php echo e(trans('pagination.booking')); ?></option>
                    <option value="10">10 <?php echo e(trans('pagination.booking')); ?></option>
                    <option value="15">15 <?php echo e(trans('pagination.booking')); ?></option>
                    <option value="20">20 <?php echo e(trans('pagination.booking')); ?></option>
                </select>
            </li>
        </ul>
    </nav>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo e(trans('messages.arrivo')); ?></th>
                    <th><?php echo e(trans('messages.partenza')); ?></th>
                    <th><?php echo e(trans('messages.numAdulti')); ?></th>
                    <th><?php echo e(trans('messages.numBambini')); ?></th>
                    <th><?php echo e(trans('messages.prezzo')); ?></th>
                    <th><?php echo e(trans('messages.email')); ?></th>
                    <th><?php echo e(trans('messages.tel')); ?></th>
                    <th><?php echo e(trans('messages.stato')); ?></th>
                    <th><?php echo e(trans('messages.orario')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $prenotazioni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prenotazione): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($prenotazione->arrivo); ?></td>
                    <td><?php echo e($prenotazione->partenza); ?></td>
                    <td><?php echo e($prenotazione->numAdulti); ?></td>
                    <td><?php echo e($prenotazione->numBambini); ?></td>
                    <td><?php echo e($prenotazione->prezzoTotale); ?></td>
                    <td><?php echo e($prenotazione->email); ?></td>
                    <td><?php echo e($prenotazione->telefono); ?></td>
                    <td><?php echo e($prenotazione->stato); ?></td>
                    <td><?php echo e($prenotazione->orarioArrivo); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\mia\ProgrammazioneWeb\elaborato\ZenzeroHolidays\resources\views/pages/prenotazioniUtente.blade.php ENDPATH**/ ?>