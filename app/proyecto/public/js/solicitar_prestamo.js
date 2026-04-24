$(document).ready(function () {
    const hoy = new Date().toISOString().split('T')[0];
    $('#fechaPrestamo').attr('min', hoy);
    $('#fechaDevolucion').attr('min', hoy);

    $('#fechaPrestamo').on('change', function () {
        const fechaP = $(this).val();
        $('#fechaDevolucion').attr('min', fechaP);
        if ($('#fechaDevolucion').val() && $('#fechaDevolucion').val() < fechaP) {
            $('#fechaDevolucion').val('');
        }
    });

    $('#formPrestamo').on('submit', function (e) {
        e.preventDefault();
        $('#mensajePrestamo').html('');

        const usuario = $('#id_usuario').val();
        const equipo  = $('#id_equipo').val();
        const fechaP  = $('#fechaPrestamo').val();
        const fechaD  = $('#fechaDevolucion').val();

        if (!usuario || !equipo || !fechaP || !fechaD) {
            $('#mensajePrestamo').html(
                '<div class="alert alert-danger">Todos los campos son obligatorios.</div>'
            );
            return;
        }

        if (fechaD < fechaP) {
            $('#mensajePrestamo').html(
                '<div class="alert alert-danger">La fecha de devolución debe ser posterior a la fecha de préstamo.</div>'
            );
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'index.php?action=guardar_prestamo',
            data: $(this).serialize(),
            success: function (response) {
                if (response.trim() === 'success') {
                    $('#mensajePrestamo').html(
                        '<div class="alert alert-success">Préstamo registrado correctamente.</div>'
                    );
                    $('#formPrestamo')[0].reset();
                } else {
                    $('#mensajePrestamo').html(
                        '<div class="alert alert-danger">Ocurrió un error al registrar. Intente de nuevo.</div>'
                    );
                }
            },
            error: function () {
                $('#mensajePrestamo').html(
                    '<div class="alert alert-danger">Error de conexión con el servidor.</div>'
                );
            }
        });
    });
});