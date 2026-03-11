//Variables
const DOMINIO_REQUERIDO = "@ufide.ac.cr";
let totalProcesados = 0;

document.addEventListener("DOMContentLoaded", function () {
  console.log("Sistema de gestion de usuarios y devoluciones");

  //Registro de usuarios
  const formularioUsuario = document.querySelector(
    'form[action="/registrar_usuario"]',
  );

  if (formularioUsuario) {
    formularioUsuario.addEventListener("submit", function (event) {
      //Detener el envio para validar
      event.preventDefault();

      //Capturas
      let inputNombre = document.getElementById("nombre");
      let inputCorreo = document.getElementById("correo");
      let selectRol = document.getElementById("rol");
      let inputPass = document.getElementById("password");

      //Validacion
      let error = false;

      //Validaciones de nombres
      if (inputNombre.value.trim().length < 3) {
        marcarError(inputNombre, "Nombre muycorto");
        error = true;
      } else {
        limpiarError(inputNombre);
      }

      //Validacion de correos
      if (!inputCorreo.value.includes(DOMINIO_REQUERIDO)) {
        marcarError(
          inputCorreo,
          "Debe ser correo que termine en (@ufide.ac.cr)",
        );
        error = true;
      } else {
        limpiarError(inputCorreo);
      }

      //Validacion de Contrasenna
      let esPassSegura = inputPass.value.length >= 8 ? true : false;
      if (!esPassSegura) {
        alert("La clave es insegura (minimo 8 caracteres)");
        marcarError(inputPass, "Insegura");
        error = true;
      }

      //Confirmacion de envio
      if (!error) {
        console.log("Validacion exitosa para: " + inputNombre.value);
        alert("Usuario registrado con exito.");
      }
    });
  }

  //Devoluciones
  // Simulación de una lista
  let prestamosActivos = [
    { id: "LPT-01", usuario: "Pablo Barquero", equipo: "Laptop" },
    { id: "TAB-05", usuario: "Maria del Sol", equipo: "Tablet" },
  ];

  const btnDevolucion = document.querySelector(".btn-warning");
  if (btnDevolucion) {
    btnDevolucion.addEventListener("click", function (e) {
      e.preventDefault();

      //Obetenemos valores
      let inputCodigo = document.querySelector(
        'input[placeholder="Ej: LPT-001"]',
      ).value;
      let estadoSelect = document.querySelector("select.form-select").value;

      //Acciones segun el estado
      switch (estadoSelect) {
        case "bueno":
          alert(
            "Equipo " +
              inputCodigo +
              " recibido correctamente. Disponible.",
          );
          break;
        case "danado":
        case "falla":
          console.warn("Alerta: El equipo requiere mantenimiento.");
          alert("Registrado: Equipo enviado a revisión por danos.");
          break;
        default:
          alert("seleccione un estado de entrega válido.");
          break;
      }
    });
  }

  //Busqueda
  const inputBusqueda = document.querySelector(
    'input[placeholder="Buscar usuario..."]',
  );
  if (inputBusqueda) {
    inputBusqueda.addEventListener("keyup", function () {
      let filtro = this.value.toLowerCase();
      let filas = document.querySelectorAll("#tablaUsuarios tr");

      //Filtro con un ciclo
      for (let i = 0; i < filas.length; i++) {
        let textoFila = filas[i].innerText.toLowerCase();
        filas[i].style.display = textoFila.includes(filtro) ? "" : "none";
      }
    });
  }
});

//Declaracion de funciones
function marcarError(elemento, mensaje) {
  elemento.style.borderColor = "red";
  console.error("Error en campo: " + elemento.id + " - " + mensaje);
}

function limpiarError(elemento) {
  elemento.style.borderColor = "#dee2e6";
}
