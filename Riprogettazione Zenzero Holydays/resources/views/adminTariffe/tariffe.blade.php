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
    $(document).ready(function() {
        var typingTimer; // Timer to delay the action
        var doneTypingInterval = 200; // Time in milliseconds after the last keystroke
        var currentPage = 1; // Set up search options

        // Set default search column to "giorno" (assicurati di avere l'attributo data-column corretto)
        var defaultColumn = 0; // Supponendo che la colonna "giorno" sia la prima (indice 0)
        $("#searchInput").attr("data-column", defaultColumn);
        $("#searchInput").attr("placeholder", "{{ trans('pagination.cercaData') }}");

        // Click event for search options
        $(".searchOptions").on("click", function(e) {
            e.preventDefault();
            var column = $(this).attr("data-column");
            $("#searchInput").attr("data-column", column);
            // Set placeholder based on selected column
            if (column === '0') { // Assuming '0' is for "giorno"
                $("#searchInput").attr("placeholder", "{{ __('pagination.cercaData') }}");
            } else if (column === '1') { // Assuming '1' is for "prezzo"
                $("#searchInput").attr("placeholder", "{{ __('pagination.cercaPrezzo') }}");
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


@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section id="form-admin">
    <div class="container-fluid px-lg-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-admin">


                    <div class="container-fluid mb-3 pt-3 text-center">
                        <h1>
                            {{ trans('messages.lista_tariffe') }}
                        </h1>
                    </div>


                    <div id="inner">

                        <div class="container-fluid px-lg-4">

                            <div class="row justify-content-center">
                                <div class="col-md-8 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-primary me-2" href="{{ route('tariffeAdmin.editGruppo') }}" style="font-size: large;">
                                        <i class="bi bi-pencil-square"></i> {{ trans('button.edit_rate_group') }}
                                    </a>
                                    <a class="btn btn-success" href="{{ route('tariffeAdmin.create') }}" style="font-size: large;">
                                        <i class="bi bi-database-add"></i> {{ trans('button.add_rate_group') }}
                                    </a>
                                </div>
                            </div>


                            <div class="row pt-3 mb-3 justify-content-center">
                                <div class="col-md-8 d-flex align-items-start">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ trans('button.cerca_per') }} &nbsp;</button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item searchOptions" href="#" data-column="0">{{ trans('button.giorno') }}</a></li>
                                                <li><a class="dropdown-item searchOptions" href="#" data-column="1">{{ trans('button.prezzo') }}</a></li>
                                            </ul>
                                        </div>
                                        <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" >
                                        <span class="input-group-addon">
                                            <i class="bi bi-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-end align-items-center" id="visualizzaTariffe">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownRowsPerPage"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ trans('button.visualizzazione') }} &nbsp;&nbsp;
                                        </button>
                                        <div class="dropdown-menu" id="menuPaginazioneTariffe" aria-labelledby="dropdownRowsPerPage">
                                            <a class="dropdown-item" href="#" data-value="5">5 {{ trans('pagination.rate') }}</a>
                                            <a class="dropdown-item" href="#" data-value="10">10 {{ trans('pagination.rate') }}</a>
                                            <a class="dropdown-item" href="#" data-value="15">15 {{ trans('pagination.rate') }}</a>
                                            <a class="dropdown-item" href="#" data-value="20">20 {{ trans('pagination.rate') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                    <th>{{ trans('button.giorno') }}</th>
                                                    <th>{{ trans('button.prezzo') }}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tariffe as $tariffa)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($tariffa->giorno)->format('d/m/Y') }}</td>
                                                        <td>€{{ $tariffa->prezzo }}</td>
                                                        <td>
                                                            <div class="btn-group-vertical" role="group">
                                                                <a class="btn btn-secondary mb-1" href="{{ route('tariffeAdmin.show', ['tariffeAdmin' => $tariffa->id]) }}">{{ trans('button.dettagli') }}</a>
                                                                @if($tariffa->prenotazione_id == null)
                                                                    <a class="btn btn-primary mb-1" href="{{ route('tariffeAdmin.edit', ['tariffeAdmin' => $tariffa->id]) }}"><i class="bi bi-pencil-square"></i> {{ trans('button.modifica') }} </a>
                                                                    <a class="btn btn-danger" href="{{ route('tariffeAdmin.destroy.confirm', ['id' => $tariffa->id]) }}"><i class="bi bi-trash"></i>{{ trans('button.elimina') }}</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <p class="text-center" id="noResultsMessage" style="display: none;">{{ trans('messages.rateSearch') }}</p>
                                    </div>
                                </div>
                            </div>

                            <nav aria-label="page navigation example" id="paginationNav">
                                <div class="justify-content-center d-flex flex-grow-1">
                                    <ul class="pagination">
                                        <li class="page-item" id="previousPage">
                                            <a class="page-link" href="#">{{ trans('pagination.previous') }}</a>
                                        </li>
                                        <li class="page-item" id="nextPage">
                                            <a class="page-link" href="#">{{ trans('pagination.next') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection
