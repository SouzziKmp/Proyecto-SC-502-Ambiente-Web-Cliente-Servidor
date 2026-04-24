<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devoluciones</title>
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
                <li>
                    <a href="index.php?action=dashboard" class="nav-link text-white <?php echo ($_GET['action'] == 'dashboard') ? 'active fw-bold' : ''; ?>">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="index.php?action=usuarios" class="nav-link text-white <?php echo ($_GET['action'] == 'usuarios') ? 'active fw-bold' : ''; ?>">
                        Usuarios
                    </a>
                </li>
                <li>
                    <a href="index.php?action=devoluciones" class="nav-link text-white <?php echo ($_GET['action'] == 'devoluciones') ? 'active fw-bold' : ''; ?>">
                        Devoluciones
                    </a>
                </li>
                <li>
                    <a href="index.php?action=equipos" class="nav-link text-white <?php echo ($_GET['action'] == 'equipos') ? 'active fw-bold' : ''; ?>">
                        Equipos
                    </a>
                </li>
                <li>
                    <a href="index.php?action=prestamos" class="nav-link text-white <?php echo ($_GET['action'] == 'prestamos') ? 'active fw-bold' : ''; ?>">
                        Préstamos
                    </a>
                </li>
                <li>
                    <a href="index.php?action=logout" class="btn btn-danger btn-sm py-1 d-flex align-items-center gap-2 shadow-sm">
                        <span>Cerrar sesión</span>
                        <i class="bi bi-box-arrow-right" style="font-size: 1rem;"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
    <main class="container mt-5">
        <h1 class="text-center mb-4">Retorno de Equipos</h1>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white"><h5 class="mb-0">Registrar Nueva Devolución</h5></div>
                    <div class="card-body">
                        <form id="formDevolucion" action="index.php?action=procesar_devolucion" method="POST" class="row g-3">
                            <div class="col-md-4"><label class="form-label">Código de Equipo</label><input type="text" name="codigo_equipo" class="form-control" placeholder="Ej: EQ-001" required></div>
                            <div class="col-md-4">
                                <label class="form-label">Estado de Entrega</label>
                                <select name="estado_entrega" class="form-select">
                                    <option value="devuelto">Devuelto</option>
                                    <option value="con_danos">Con daños</option>
                                    <option value="en prestamo">En préstamo</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end"><button type="submit" class="btn btn-dark w-100">Procesar Devolución</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <h3 class="mb-3">Historial Reciente de Préstamos</h3>
            <div class="card shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Usuario</th>
                                    <th>Código</th>
                                    <th>Equipo</th>
                                    <th>Préstamo</th>
                                    <th>Retorno</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($historial)): foreach ($historial as $h): ?>
                                <tr>
                                    <td><?= htmlspecialchars($h['usuario']) ?></td>
                                    <td><?= htmlspecialchars($h['codigo_inventario']) ?></td>
                                    <td><?= htmlspecialchars($h['equipo']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($h['fecha_prestamo'])) ?></td>
                                    <td><?= $h['fecha_devo_real'] ? date('d/m/Y', strtotime($h['fecha_devo_real'])) : '<span class="text-danger">Pendiente</span>' ?></td>
                                    <td>
                                        <?php 
                                            $class = 'bg-warning text-dark'; $txt = 'En préstamo';
                                            if($h['estado'] == 'devuelto'){ $class = 'bg-success'; $txt = 'Devuelto'; }
                                            elseif($h['estado'] == 'con_danos'){ $class = 'bg-danger'; $txt = 'Con daños'; }
                                        ?>
                                        <span class="badge <?= $class ?>"><?= $txt ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="6" class="text-center py-3">Sin registros.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="mt-5 p-3 text-center border-top"><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>
    <script src="public/js/devoluciones.js"></script>
</body>
</html>