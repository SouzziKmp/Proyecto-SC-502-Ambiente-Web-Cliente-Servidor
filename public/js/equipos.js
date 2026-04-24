fetch("http://localhost:8080/api/equipos")
.then(response => response.json())
.then(data => {

    const tabla = document.getElementById("tablaEquipos");

    data.forEach(equipo => {

        const fila = `
        <tr>

            <td>
                <img src="${equipo.imagen}" width="80" class="img-thumbnail">
            </td>

            <td>${equipo.codigo}</td>
            <td>${equipo.tipo}</td>
            <td>${equipo.marca}</td>
            <td>${equipo.modelo}</td>
            <td>${equipo.numeroSerie}</td>
            <td>${equipo.estado}</td>

            <td>
                <button class="btn btn-primary btn-sm" onclick="prestarEquipo(${equipo.id})"><i class="bi bi-share"></i> Prestar</button>
                <button class="btn btn-warning btn-sm" onclick="editarEquipo(${equipo.id})"><i class="bi bi-pencil"></i> Editar</button>
                <button class="btn btn-danger btn-sm" onclick="eliminarEquipo(${equipo.id})"><i class="bi bi-trash"></i> Eliminar</button>
            </td>

        </tr>
        `;

        tabla.innerHTML += fila;

    });

});

// Funciones para los botones
function prestarEquipo(id) {
    window.location.href = `prestamo.html?id=${id}`;
}

function editarEquipo(id) {
    window.location.href = `editar_equipo.html?id=${id}`;
}

function eliminarEquipo(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este equipo?')) {
        fetch(`http://localhost:8080/api/equipos/${id}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.ok) {
                alert('Equipo eliminado exitosamente');
                location.reload(); // Recargar la página para actualizar la lista
            } else {
                alert('Error al eliminar el equipo');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar el equipo');
        });
    }
}