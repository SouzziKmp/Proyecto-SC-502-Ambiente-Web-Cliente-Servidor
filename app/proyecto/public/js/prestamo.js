$(document).ready(function () {
    // === LÓGICA PARA EL LISTADO (mis_prestamos.php) ===
    function actualizarContadores() {
        let activos = 0;
        let devueltos = 0;
        let total = 0;

        $('#tablaPrestamos tbody tr:visible').each(function () {
            if ($(this).find('td').length > 1) {
                total++;
                const estado = $(this).find('.badge').text().trim().toLowerCase();
                if (estado === 'activo') activos++;
                if (estado === 'devuelto') devueltos++;
            }
        });

        $('#contadorActivos').text(activos);
        $('#contadorDevueltos').text(devueltos);
        $('#contadorTotal').text(total);
    }

    if ($('#tablaPrestamos').length > 0) {
        actualizarContadores();
    }

    $('#buscador').on('keyup', function () {
        const valor = $(this).val().toLowerCase();
        $('#tablaPrestamos tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
        actualizarContadores();
    });

    // === LÓGICA PARA EL REGISTRO (solicitar_prestamo.php) ===
    const formPrestamo = document.getElementById("formPrestamo");

    if (formPrestamo) {
        formPrestamo.addEventListener("submit", function (event) {
            event.preventDefault();

            // Referencias a los elementos del DOM
            const idUsuario = document.getElementsByName("id_usuario")[0].value;
            const idEquipo = document.getElementsByName("id_equipo")[0].value;
            const fechaPrestamo = document.getElementsByName("fechaPrestamo")[0].value;
            const fechaDevolucion = document.getElementsByName("fechaDevolucion")[0].value;
            const mensaje = document.getElementById("mensajePrestamo") || document.createElement("div");

            if (!document.getElementById("mensajePrestamo")) {
                mensaje.id = "mensajePrestamo";
                formPrestamo.prepend(mensaje);
            }

            // Validaciones básicas
            if (!idUsuario || !idEquipo || !fechaPrestamo || !fechaDevolucion) {
                mensaje.innerHTML = `<div class="alert alert-danger">Todos los campos son obligatorios.</div>`;
                return;
            }

            if (fechaDevolucion < fechaPrestamo) {
                mensaje.innerHTML = `<div class="alert alert-danger">La fecha de devolución no puede ser menor a la de préstamo.</div>`;
                return;
            }

            // Envío al controlador mediante AJAX
            const formData = new FormData();
            formData.append('id_usuario', idUsuario);
            formData.append('id_equipo', idEquipo);
            formData.append('fechaPrestamo', fechaPrestamo);
            formData.append('fechaDevolucion', fechaDevolucion);

            fetch('index.php?action=guardar_prestamo', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "success") {
                    mensaje.innerHTML = `<div class="alert alert-success">Préstamo solicitado correctamente. Redirigiendo...</div>`;
                    formPrestamo.reset();
                    setTimeout(() => {
                        window.location.href = 'index.php?action=mis_prestamos';
                    }, 1500);
                } else {
                    mensaje.innerHTML = `<div class="alert alert-danger">Error al registrar el préstamo en el servidor.</div>`;
                    console.error("Respuesta servidor:", data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mensaje.innerHTML = `<div class="alert alert-danger">Error de conexión con el servidor.</div>`;
            });
        });
    }
});