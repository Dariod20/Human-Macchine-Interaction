// paginationScript.js

// Variabili globali per la paginazione
var currentPage = 1;
var rowsPerPage;
var $tableRows;
var totalPages;

// Funzione di paginazione resa globale
function showPage(page) {
    var start = (page - 1) * rowsPerPage;
    var end = start + rowsPerPage;

    $tableRows.hide().slice(start, end).show();

    // Rimuovi i numeri di pagina esistenti
    $(".page-item.pageNumber").remove();

    // Calcola quali numeri di pagina visualizzare
    var startPage = Math.max(1, currentPage - 1);
    var endPage = Math.min(startPage + 2, totalPages);

    // Aggiungere i numeri di pagina calcolati al markup HTML
    for (var i = startPage; i <= endPage; i++) {
        var $li = $("<li>", { class: "page-item pageNumber" });
        var $link = $("<a>", { class: "page-link", href: "#", text: i });
        if (i === currentPage) {
            $li.addClass("active");
        }
        $li.append($link);
        $li.insertBefore("#nextPage");
    }
}

$(document).ready(function() {
    // Inizializza variabili di paginazione
    rowsPerPage = parseInt($("#rowsPerPage").val());
    $tableRows = $(".table tbody tr");
    totalPages = Math.ceil($tableRows.length / rowsPerPage);

    // Funzioni per navigare tra le pagine
    function goToPreviousPage() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    }

    function goToNextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    }

    // Evento per cambiare righe per pagina
    $("#rowsPerPage").on("change", function() {
        rowsPerPage = parseInt($(this).val());
        totalPages = Math.ceil($tableRows.length / rowsPerPage);
        showPage(currentPage);
    });

    showPage(currentPage);

    $("#previousPage").on("click", goToPreviousPage);
    $("#nextPage").on("click", goToNextPage);

    $(document).on("click", ".pageNumber", function() {
        var page = parseInt($(this).text());
        currentPage = page;
        showPage(currentPage);
    });
});
