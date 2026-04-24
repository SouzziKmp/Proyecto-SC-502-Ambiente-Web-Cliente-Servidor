<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos Registrados</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
<main class="container mt-4">
    <h1 class="text-center mb-4">Inventario de Equipos</h1>
    <?php if (isset($_GET['eliminado'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>Equipo desactivado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <div class="d-flex justify-content-between mb-3">
        <a href="index.php?action=registrar" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i> Registrar nuevo equipo
        </a>
        <input type="text" id="buscarEquipo" class="form-control w-25" placeholder="Buscar equipo...">
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Icono</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaEquipos">
                        <?php if (empty($equipos)): ?>
                            <tr><td colspan="7" class="text-center py-4">No hay equipos registrados.</td></tr>
                        <?php else: ?>
                            <?php foreach ($equipos as $equipo): ?>
                            <tr>
                                <td class="text-center">
                                    <i class="bi bi-laptop fs-4 text-secondary"></i>
                                </td>
                                <td><?= htmlspecialchars($equipo['codigo_inventario']) ?></td>
                                <td><?= htmlspecialchars($equipo['nombre']) ?></td>
                                <td><?= htmlspecialchars($equipo['categoria']) ?></td>
                                <td><?= htmlspecialchars($equipo['marca']) ?></td>
                                <td><span class="badge bg-success"><?= ucfirst($equipo['estado']) ?></span></td>
                                <td class="text-center">
                                    <a href="index.php?action=editar&id=<?= $equipo['id_equipo'] ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST" action="index.php?action=eliminar" style="display:inline;" onsubmit="return confirm('¿Desactivar equipo?')">
                                        <input type="hidden" name="id_equipo" value="<?= $equipo['id_equipo'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">
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
</main>
<footer class="mt-5 p-3 text-center border-top"><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>
<script src="public/js/equipos.js"></script>
</body>
</html>