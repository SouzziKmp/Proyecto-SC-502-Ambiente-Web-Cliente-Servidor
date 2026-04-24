$(function () {
    console.log("Dashboard activo");

    $("#buscarPrestamo").on("keyup", function() {
        let valor = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {

            if ($(this).find("td").length > 1) {
                $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
            }
        });
    });

    $('a[href*="action=logout"]').on("click", function (e) {
        if (!confirm("¿Deseas cerrar la sesión actual?")) {
            e.preventDefault();
        }
    });

    $("table tbody tr").on("mouseenter", function() {
        $(this).addClass("table-light");
    }).on("mouseleave", function() {
        $(this).removeClass("table-light");
    });
    
    $(".btn-primary.rounded-pill").on("click", function() {
        console.log("Abriendo formulario de préstamo...");
    });
});