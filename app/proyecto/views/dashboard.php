<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistema de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="public/css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar bg-dark border-bottom border-body p-3" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="h4 text-white m-0">Sistema de préstamo de equipo</h1>
            <ul class="d-flex align-items-center list-unstyled m-0 gap-3">
                <li><a href="index.php?action=dashboard" class="nav-link text-white active fw-bold">Dashboard</a></li>
                <li><a href="index.php?action=usuarios" class="nav-link text-white">Usuarios</a></li>
                <li><a href="index.php?action=devoluciones" class="nav-link text-white">Devoluciones</a></li>
                <li><a href="index.php?action=equipos" class="nav-link text-white">Equipos</a></li>
                <li><a href="index.php?action=prestamos" class="nav-link text-white">Préstamos</a></li>
                <li>
                    <a href="index.php?action=logout" class="btn btn-danger btn-sm d-flex align-items-center gap-2">
                        <span>Cerrar sesión</span>
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Panel de Control</h2>
            <p class="text-muted">Resumen del estado de los equipos.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-white p-4 shadow-sm border-0 h-100">
                <p class="text-muted small fw-bold mb-1">EQUIPOS TOTALES</p>
                <h3 class="fw-bold mb-0"><?= $datos['total_equipos']; ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-white p-4 shadow-sm border-0 h-100">
                <p class="text-muted small fw-bold mb-1">EN PRÉSTAMO</p>
                <h3 class="fw-bold mb-0 text-primary"><?= $datos['prestados']; ?></h3>
            </div>
        </div>
    </div>

    <div class="card bg-white mt-5 p-4 shadow-sm border-0">
        <h5 class="fw-bold mb-4">Préstamos en curso</h5>
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>EQUIPO</th>
                        <th>USUARIO</th>
                        <th>FECHA SALIDA</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($datos['lista_prestamos'])): ?>
                        <?php foreach ($datos['lista_prestamos'] as $p): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($p['equipo']); ?></strong></td>
                                <td><?= htmlspecialchars($p['usuario']); ?></td>
                                <td><?= $p['fecha_prestamo']; ?></td>
                                <td><span class="badge bg-success">Activo</span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No hay préstamos activos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>