document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formDevolucion");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch("index.php?action=procesar_devolucion", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                if (data.includes("success")) {
                    alert("Estado actualizado exitosamente.");
                    window.location.reload();
                } else {
                    alert("Error: No se encontró el código de equipo o no tiene préstamos registrados.");
                }
            })
            .catch(err => console.error(err));
        });
    }
});