// paginationScript.js

    // Variabili di paginazione
    var currentPage = 1;
    var rowsPerPage = 5; // Valore predefinito per le righe per pagina
    var $tableRows = $(".table tbody tr");
    var totalPages = Math.ceil($tableRows.length / rowsPerPage);

    function showPage(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;

        $tableRows.hide().slice(start, end).show();

        // Disabilita il pulsante "Precedente" se siamo alla prima pagina
        $("#previousPage").toggleClass("disabled", currentPage === 1);
        $("#nextPage").toggleClass("disabled", currentPage === totalPages);

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

    // Gestione del cambiamento del numero di righe per pagina tramite il dropdown
    $(".dropdown-menu .dropdown-item").on("click", function(event) {
        event.preventDefault();
        rowsPerPage = parseInt($(this).data("value"));
        $("#dropdownRowsPerPage").text(rowsPerPage + " prenotazioni per pagina");
        totalPages = Math.ceil($tableRows.length / rowsPerPage);
        currentPage = 1; // Resetta alla prima pagina
        showPage(currentPage);
    });

    //showPage(currentPage);

    $("#previousPage").on("click", goToPreviousPage);
    $("#nextPage").on("click", goToNextPage);

    $(document).on("click", ".pageNumber", function() {
        var page = parseInt($(this).text());
        currentPage = page;
        showPage(currentPage);
    });
});



