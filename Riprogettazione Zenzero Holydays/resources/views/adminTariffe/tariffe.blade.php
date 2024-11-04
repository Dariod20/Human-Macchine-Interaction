@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title', 'Tariffe')

@section('script')
<script src="{{ url('/') }}/js/paginationScript.js"></script>
@endsection

@section('active_tariffe','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Tariffe</li>
@endsection

@section('corpo')
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
        {{ trans('messages.lista_tariffe') }}
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
            <a class="btn btn-primary me-2" href="{{ route('tariffeAdmin.editGruppo') }}"><i class="bi bi-pencil-square"></i> Modifica gruppo di tariffe</a>
            <a class="btn btn-success " href="{{ route('tariffeAdmin.create') }}"><i class="bi bi-database-add"></i>Aggiungi gruppo di tariffe</a>
        </div>
    </div>
</div>

<nav aria-label="page navigation example" id="paginationNav" class="d-flex justify-content-between align-items-center">
    <!-- Primo div: Centro -->
    <div class="justify-content-center d-flex flex-grow-1" id="navTariffe">
        <ul class="pagination">
            <li class="page-item" id="previousPage">
                <a class="page-link" href="#">{{ trans('pagination.previous') }}</a>
            </li>
            <li class="page-item" id="nextPage">
                <a class="page-link" href="#">{{ trans('pagination.next') }}</a>
            </li>
        </ul>
    </div>

    <!-- Secondo div: Lato destro -->
    <div class="col-md-4 d-flex justify-content-end align-items-center" id="visualizzaTariffe">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownRowsPerPage"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ trans('button.visualizzazione') }} &nbsp;&nbsp;
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownRowsPerPage">
                <a class="dropdown-item" href="#" data-value="5">5 {{ trans('pagination.booking') }}</a>
                <a class="dropdown-item" href="#" data-value="10">10 {{ trans('pagination.booking') }}</a>
                <a class="dropdown-item" href="#" data-value="15">15 {{ trans('pagination.booking') }}</a>
                <a class="dropdown-item" href="#" data-value="20">20 {{ trans('pagination.booking') }}</a>
            </div>
        </div>
    </div>
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
                        @foreach($tariffe as $tariffa)
                            <tr>
                                <td>{{ $tariffa->giorno }}</td>
                                <td>€{{ $tariffa->prezzo }}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group">
                                        <a class="btn btn-secondary mb-1" href="{{ route('tariffeAdmin.show', ['tariffeAdmin' => $tariffa->id]) }}">Dettagli</a>
                                        @if($tariffa->prenotazione_id == null)
                                            <a class="btn btn-primary mb-1" href="{{ route('tariffeAdmin.edit', ['tariffeAdmin' => $tariffa->id]) }}"><i class="bi bi-pencil-square"></i> Modifica</a>
                                            <a class="btn btn-danger" href="{{ route('tariffeAdmin.destroy.confirm', ['id' => $tariffa->id]) }}"><i class="bi bi-trash"></i> Elimina</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
