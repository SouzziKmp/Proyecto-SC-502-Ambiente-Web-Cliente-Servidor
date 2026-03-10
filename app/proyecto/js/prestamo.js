document.addEventListener("DOMContentLoaded", function () {
    const formPrestamo = document.getElementById("formPrestamo");

    if (formPrestamo) {
        formPrestamo.addEventListener("submit", function (event) {
            event.preventDefault();

            const usuario = document.getElementById("usuario").value.trim();
            const equipo = document.getElementById("equipo").value;
            const fechaPrestamo = document.getElementById("fechaPrestamo").value;
            const fechaDevolucion = document.getElementById("fechaDevolucion").value;
            const mensaje = document.getElementById("mensajePrestamo");

            mensaje.innerHTML = "";

            if (usuario === "" || equipo === "" || fechaPrestamo === "" || fechaDevolucion === "") {
                mensaje.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Todos los campos son obligatorios.
                    </div>
                `;
                return;
            }

            if (fechaDevolucion < fechaPrestamo) {
                mensaje.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        La fecha de devolución no puede ser menor que la fecha de préstamo.
                    </div>
                `;
                return;
            }

            mensaje.innerHTML = `
                <div class="alert alert-success" role="alert">
                    Préstamo solicitado correctamente.
                </div>
            `;

            formPrestamo.reset();
        });
    }
});