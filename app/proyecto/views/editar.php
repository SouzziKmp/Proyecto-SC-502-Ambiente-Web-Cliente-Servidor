<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
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
<main>
    <section class="formEditar mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <h1 class="text-center mb-4 h2">Editar Equipos y Periféricos</h1>
                            <?php if (!empty($errores)): ?>
                                <div class="alert alert-danger">
                                    <p class="fw-bold">Faltan completar los siguientes campos:</p>
                                    <ul class="mb-0">
                                        <?php foreach ($errores as $error): ?>
                                            <li><?= htmlspecialchars($error) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="index.php?action=actualizar">
                                <input type="hidden" name="id_equipo" value="<?= $equipo['id_equipo'] ?>">
                                <div class="mb-3">
                                    <label for="codigo_inventario" class="form-label">Código del equipo</label>
                                    <input type="text" class="form-control bg-light" id="codigo_inventario" value="<?= htmlspecialchars($equipo['codigo_inventario']) ?>" readonly>
                                    <small class="text-muted">El código no se puede modificar.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del equipo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($datos['nombre'] ?? $equipo['nombre']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_categoria" class="form-label">Tipo de equipo</label>
                                    <select class="form-select" id="id_categoria" name="id_categoria" required>
                                        <?php foreach ($categorias as $cat): ?>
                                            <option value="<?= $cat['id_categoria'] ?>" <?= ($equipo['id_categoria'] == $cat['id_categoria']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="marca" class="form-label">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca" value="<?= htmlspecialchars($datos['marca'] ?? $equipo['marca']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="marcamodelo" class="form-label">Modelo</label>
                                    <input type="text" class="form-control" id="marcamodelo" name="marcamodelo" value="<?= htmlspecialchars($datos['marcamodelo'] ?? $equipo['marcamodelo']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="numero_serie" class="form-label">Número de Serie</label>
                                    <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="<?= htmlspecialchars($datos['numero_serie'] ?? $equipo['numero_serie']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="disponible" <?= ($equipo['estado'] == 'disponible') ? 'selected' : '' ?>>Disponible</option>
                                        <option value="prestado" <?= ($equipo['estado'] == 'prestado') ? 'selected' : '' ?>>Prestado</option>
                                        <option value="en reparacion" <?= ($equipo['estado'] == 'en reparacion') ? 'selected' : '' ?>>En reparación</option>
                                    </select>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <a href="index.php?action=equipos" class="btn btn-secondary">Volver al inventario</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer class="mt-5 p-3 text-center border-top"><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>
</body>
</html>