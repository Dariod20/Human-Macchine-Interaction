@extends('layouts.master')

@section('titolo')
Prenotazioni
@endsection

@section('script')
<script src="{{ url('/') }}/js/paginationScript.js"></script>
@endsection

@section('active_prenotazioniAdmin','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Prenotazioni</li>
@endsection

@section('corpo')
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
        {{ trans('messages.lista_prenotazioni') }}
    </h1>
</div>

<div class="container-fluid px-lg-4 mt-4">
    <div class="row mb-3 pt-3">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button" placeholder="{{ trans('pagination.cerca') }}">
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownRowsPerPage"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ trans('button.visualizzazione') }} &nbsp&nbsp
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownRowsPerPage">
                    <a class="dropdown-item" href="#" data-value="5">5 {{ trans('pagination.booking') }}</a>
                    <a class="dropdown-item" href="#" data-value="10">10 {{ trans('pagination.booking') }}</a>
                    <a class="dropdown-item" href="#" data-value="15">15 {{ trans('pagination.booking') }}</a>
                    <a class="dropdown-item" href="#" data-value="20">20 {{ trans('pagination.booking') }}</a>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation example" id="paginationNav">
        <ul class="pagination justify-content-center">
            <li class="page-item" id="previousPage"><a class="page-link" href="#"> {{ trans('pagination.previous') }} </a></li>
            <li class="page-item" id="nextPage"><a class="page-link" href="#"> {{ trans('pagination.next') }} </a></li>
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
                            <th> {{ trans('messages.arrivo') }} </th>
                            <th> {{ trans('messages.partenza') }} </th>
                            <th> {{ trans('messages.prezzo') }} </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prenotazioni as $prenotazione)
                            <tr>
                                <td>{{ $prenotazione->arrivo }}</td>
                                <td>{{ $prenotazione->partenza }}</td>
                                <td>{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</td>
                                <td>
                                    <div class="btn-group-vertical" role="group">
                                        <a class="btn btn-secondary mb-1" href="{{ route('prenotazioniAdmin.show', ['prenotazioniAdmin' => $prenotazione->id]) }}">Dettagli</a>
                                        <a class="btn btn-primary mb-1" href="{{ route('prenotazioniAdmin.edit', ['prenotazioniAdmin' => $prenotazione->id]) }}"><i class="bi bi-pencil-square"></i> Modifica</a>
                                        <a class="btn btn-danger" href="{{ route('prenotazioniAdmin.destroy.confirm', ['id' => $prenotazione->id]) }}"><i class="bi bi-trash"></i> Elimina</a>
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
