<?php 
$esEdicion = isset($usuario); 
$titulo = $esEdicion ? "Editar Usuario" : "Registro de Usuarios";
$actionUrl = $esEdicion ? "index.php?action=actualizar_usuario" : "index.php?action=guardar_usuario";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<header>
    <nav class="navbar bg-dark border-bottom border-body p-3" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="h4 text-white m-0">Sistema de préstamo de equipo</h1>
            <ul class="d-flex align-items-center list-unstyled m-0 gap-3">
                <li><a href="index.php?action=dashboard" class="nav-link text-white">Dashboard</a></li>
                <li><a href="index.php?action=usuarios" class="nav-link text-white active fw-bold">Usuarios</a></li>
                <li><a href="index.php?action=logout" class="btn btn-danger btn-sm">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</header>
<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h1 class="text-center mb-4 h2 fw-bold"><?= $titulo ?></h1>
                    <form method="POST" action="<?= $actionUrl ?>">
                        <?php if ($esEdicion): ?>
                            <input type="hidden" name="id_usuarios" value="<?= $usuario['id_usuarios'] ?>">
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre" value="<?= $esEdicion ? htmlspecialchars($usuario['nombre']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Cédula</label>
                            <input type="text" class="form-control" name="cedula" value="<?= $esEdicion ? htmlspecialchars($usuario['cedula']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" value="<?= $esEdicion ? htmlspecialchars($usuario['email']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rol del Sistema</label>
                            <select class="form-select" name="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="profesor" <?= ($esEdicion && $usuario['tipo_usuario'] == 'profesor') ? 'selected' : '' ?>>Profesor</option>
                                <option value="alumno" <?= ($esEdicion && $usuario['tipo_usuario'] == 'alumno') ? 'selected' : '' ?>>Alumno</option>
                            </select>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg"><?= $esEdicion ? 'Actualizar Usuario' : 'Registrar Usuario' ?></button>
                            <a href="index.php?action=usuarios" class="btn btn-secondary mt-2">Volver a la lista</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>