$(document).ready(function () {
    $('#buscarEquipo').on('input', function () {
        const termino = $(this).val().toLowerCase();
        $('#tablaEquipos tr').each(function () {
            const texto = $(this).text().toLowerCase();
            $(this).toggle(texto.indexOf(termino) > -1);
        });
    });
});

function prestarEquipo(id) {
    window.location.href = `index.php?action=solicitar&id_equipo=${id}`;
}

function editarEquipo(id) {
    window.location.href = `index.php?action=editar&id=${id}`;
}