$(function () {
    $("#formLogin").on("submit", function (event) {
        event.preventDefault();

        const email = $("#email").val().trim();
        const password = $("#password").val().trim();

        $.ajax({
            url: "index.php?action=validar_login",
            type: "POST",
            data: { email: email, password: password },
            dataType: "json",
            success: function (res) {
                if (res.status === "success") {
                    // Redirección inmediata al dashboard
                    window.location.replace("index.php?action=dashboard");
                } else {
                    alert(res.message);
                }
            },
            error: function (xhr) {
                console.error("Error del servidor:", xhr.responseText);
                alert("Error técnico en el servidor. Revisa la consola.");
            }
        });
    });
});