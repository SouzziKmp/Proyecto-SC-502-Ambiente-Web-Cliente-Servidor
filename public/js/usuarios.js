document.addEventListener("DOMContentLoaded", function () {
    const formRegistro = document.getElementById("formRegistroUsuario");
    const busqueda = document.getElementById("busqueda");

    if (formRegistro) {
        formRegistro.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(formRegistro);
            fetch("index.php?action=guardar", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert("Usuario registrado.");
                    window.location.href = "index.php?action=usuarios";
                } else {
                    alert("Error al registrar.");
                }
            });
        });
    }

    if (busqueda) {
        busqueda.addEventListener("keyup", function () {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll("#tablaUsuarios tr");
            filas.forEach(fila => {
                fila.style.display = fila.innerText.toLowerCase().includes(filtro) ? "" : "none";
            });
        });
    }
});