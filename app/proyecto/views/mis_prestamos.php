<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Prestamos</title>
    <link rel="stylesheet" href="../css/mis_prestamos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar bg-dark border-bottom border-body p-3" data-bs-theme="dark">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="h4 text-white m-0">Sistema de prestamo de equipo</h1>
                <ul id="nav-menu" class="d-flex align-items-center list-unstyled m-0 gap-3">
                    <li><a href="index.php?action=usuarios" class="nav-link text-white">Usuarios</a></li>
                    <li><a href="index.php?action=devoluciones" class="nav-link text-white">Devoluciones</a></li>
                    <li><a href="index.php?action=equipos" class="nav-link text-white">Equipos</a></li>
                    <li><a href="index.php?action=prestamos" class="nav-link text-white fw-bold">Prestamos</a></li>
                    <li><a href="login.html" class="btn btn-secondary">Cerrar sesion <i class="bi bi-box-arrow-in-right"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container py-5">
        <section class="mb-4">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">Prestamos Activos</h2>
                    <p class="text-muted mb-0">Consulte los prestamos registrados actualmente dentro del sistema.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="index.php?action=solicitar" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Nuevo prestamo
                    </a>
                </div>
            </div>
        </section>

        <section class="mb-4">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted mb-1">Prestamos activos</p>
                                <h4 class="fw-bold mb-0 text-primary" id="contadorActivos">0</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted mb-1">Devueltos</p>
                                <h4 class="fw-bold mb-0 text-success" id="contadorDevueltos">0</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <p class="text-muted mb-1">Total registros</p>
                                <h4 class="fw-bold mb-0 text-secondary" id="contadorTotal">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h5 class="fw-bold mb-0">Listado de prestamos</h5>
                        <input type="text" id="buscador" class="form-control w-auto" placeholder="Buscar prestamo...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle mb-0" id="tablaPrestamos">
                            <thead class="table-dark">
                                <tr>
                                    <th>Usuario</th>
                                    <th>Equipo</th>
                                    <th>Fecha prestamo</th>
                                    <th>Fecha devolucion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($prestamos)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No hay prestamos registrados.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($prestamos as $p): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($p['usuario']) ?></td>
                                            <td><?= htmlspecialchars($p['equipo']) ?></td>
                                            <td><?= $p['fecha_prestamo'] ?></td>
                                            <td><?= $p['fecha_devo_esti'] ?></td>
                                            <td>
                                                <?php if ($p['estado'] === 'activo'): ?>
                                                    <span class="badge bg-success">Activo</span>
                                                <?php elseif ($p['estado'] === 'devuelto'): ?>
                                                    <span class="badge bg-secondary">Devuelto</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Por vencer</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex gap-2 flex-wrap">
                        <a href="index.php?action=prestamos" class="btn btn-outline-dark">Volver al modulo</a>
                        <a href="index.php?action=solicitar" class="btn btn-primary">Registrar otro prestamo</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer-custom">
        <p>&copy; 2026 Sistema de prestamo de equipos</p>
    </footer>

    <script>
    $(document).ready(function () {
        // Contar estados y actualizar contadores
        let activos = 0, devueltos = 0, total = 0;
        $('#tablaPrestamos tbody tr').each(function () {
            total++;
            const badge = $(this).find('.badge');
            if (badge.hasClass('bg-success')) activos++;
            if (badge.hasClass('bg-secondary')) devueltos++;
        });
        $('#contadorActivos').text(activos);
        $('#contadorDevueltos').text(devueltos);
        $('#contadorTotal').text(total);

        // Buscador en tiempo real
        $('#buscador').on('keyup', function (