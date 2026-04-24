<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos Registrados</title>
    <link rel="stylesheet" href="public/css/equipos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
 
<header>
    <nav class="navbar bg-dark border-bottom border-body p-3" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="h4 text-white m-0">Sistema de prestamo de equipo</h1>
            <ul class="d-flex align-items-center list-unstyled m-0 gap-3">
                <li><a href="usuarios.php" class="nav-link text-white">Usuarios</a></li>
                <li><a href="devoluciones.php" class="nav-link text-white">Devoluciones</a></li>
                <li><a href="equipos.php" class="nav-link text-white fw-bold">Equipos</a></li>
                <li><a href="prestamo.php" class="nav-link text-white">Prestamos</a></li>
                <li>
                    <a href="login.php" class="btn btn-secondary">
                        Logout <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
 
<main>
    <section class="equiposRegistrados container mt-4">
        <h1 class="text-center mb-4">Inventario de Equipos</h1>
 
        <?php if (isset($_GET['registrado'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>Equipo registrado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (isset($_GET['editado'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>Equipo actualizado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (isset($_GET['eliminado'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>Equipo eliminado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>Ocurrió un error. Intente de nuevo.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
 
        <div class="d-flex justify-content-between mb-3">
            <a href="equipos.php?accion=registrar"
               class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Registrar nuevo equipo
            </a>
            <input type="text" id="buscarEquipo" class="form-control w-25" placeholder="Buscar equipo...">
        </div>
 
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="table-layout: fixed;">
                        <thead class="table-dark">
                            <tr>
                                <th style="width:8%;">Icono</th>
                                <th style="width:11%;">Código</th>
                                <th style="width:13%;">Nombre</th>
                                <th style="width:11%;">Tipo</th>
                                <th style="width:10%;">Marca</th>
                                <th style="width:11%;">Modelo</th>
                                <th style="width:13%;">N° Serie</th>
                                <th style="width:10%;">Estado</th>
                                <th style="width:13%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEquipos">
                            <?php if (empty($equipos)): ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        No hay equipos registrados.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($equipos as $equipo): ?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <?php
                                        $iconos = [
                                            'Desktop'   => 'bi-pc-display',
                                            'Laptop'    => 'bi-laptop',
                                            'Tablet'    => 'bi-tablet',
                                            'Monitor'   => 'bi-display',
                                            'Teclado'   => 'bi-keyboard',
                                            'Mouse'     => 'bi-mouse',
                                            'Impresora' => 'bi-printer',
                                            'Proyector' => 'bi-projector',
                                        ];
                                        $icono = $iconos[$equipo['categoria']] ?? 'bi-box';
                                        ?>
                                        <i class="bi <?= $icono ?> fs-4 text-secondary"></i>
                                    </td>
                                    <td class="align-middle"><?= htmlspecialchars($equipo['codigo_inventario']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($equipo['nombre']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($equipo['categoria']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($equipo['marca']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($equipo['marcamodelo']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($equipo['numero_serie'] ?? '—') ?></td>
                                    <td class="align-middle">
                                        <?php
                                        $badges = [
                                            'disponible'    => 'bg-success',
                                            'prestado'      => 'bg-warning text-dark',
                                            'en reparacion' => 'bg-danger',
                                        ];
                                        $clase = $badges[$equipo['estado']] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge <?= $clase ?>">
                                            <?= ucfirst(htmlspecialchars($equipo['estado'])) ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="/Proyecto-SC-502-Ambiente-Web-Cliente-Servidor/app/proyecto/html/equipos.php?accion=editar&id=<?= $equipo['id_equipo'] ?>"
                                           class="btn btn-sm btn-warning me-1" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form method="POST"
                                              action="/Proyecto-SC-502-Ambiente-Web-Cliente-Servidor/app/proyecto/html/equipos.php?accion=eliminar"
                                              style="display:inline;"
                                              onsubmit="return confirm('¿Eliminar el equipo <?= htmlspecialchars($equipo['codigo_inventario'], ENT_QUOTES) ?>? Esta acción no se puede deshacer.')">
                                            <input type="hidden" name="id_equipo" value="<?= $equipo['id_equipo'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
 
<footer class="mt-4">
    <p class="text-center">&copy; 2026 Sistema de prestamo de equipos</p>
</footer>
 
<script>
    document.getElementById('buscarEquipo').addEventListener('input', function () {
        const termino = this.value.toLowerCase();
        document.querySelectorAll('#tablaEquipos tr').forEach(function (fila) {
            fila.style.display = fila.textContent.toLowerCase().includes(termino) ? '' : 'none';
        });
    });
</script>
 
</body>
</html>

    <footer class="mt-4">
        <p class="text-center">&copy; 2026 Sistema de prestamo de equipos</p>
    </footer>

    <script>
        // Búsqueda en tiempo real sobre las filas de la tabla
        document.getElementById('buscarEquipo').addEventListener('input', function () {
            const termino = this.value.toLowerCase();
            document.querySelectorAll('#tablaEquipos tr').forEach(function (fila) {
                fila.style.display = fila.textContent.toLowerCase().includes(termino) ? '' : 'none';
            });
        });
    </script>

</body>
</html>