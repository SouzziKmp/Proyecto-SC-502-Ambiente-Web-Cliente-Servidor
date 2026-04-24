<?php
// views/equipos/editar.php
// Variables disponibles: $equipo (array), $categorias (array), $errores (array)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
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
                <li><a href="equipos.php" class="nav-link text-white">Equipos</a></li>
                <li><a href="prestamo.php" class="nav-link text-white fw-bold">Prestamos</a></li>
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
    <section class="formEditar mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <h1 class="text-center mb-4 h2">Editar Equipos y Periféricos</h1>
 
                            <?php if (!empty($errores)): ?>
                                <div style="
                                    border:0.5px solid #f5c2c7;
                                    border-radius:8px;
                                    background:#f8d7da;
                                    padding:12px 16px;
                                    margin-bottom:16px;
                                ">
                                    <p style="font-size:13px;font-weight:600;color:#842029;margin:0 0 8px 0;">
                                        Faltan completar los siguientes campos:
                                    </p>
                                    <ul style="margin:0;padding-left:0;list-style:none;">
                                        <?php foreach ($errores as $error): ?>
                                            <li style="padding:3px 0;font-size:13px;color:#842029;display:flex;gap:6px;">
                                                <span>⚠</span><span><?= htmlspecialchars($error) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
 
                            <form method="POST" action="equipos.php?accion=editar">
 
                                <!-- ID oculto para identificar el equipo -->
                                <input type="hidden" name="id_equipo" value="<?= $equipo['id_equipo'] ?>">
 
                                <div class="mb-3">
                                    <label for="codigo_inventario" class="form-label">Código del equipo</label>
                                    <input type="text"
                                           class="form-control bg-light"
                                           id="codigo_inventario"
                                           value="<?= htmlspecialchars($equipo['codigo_inventario']) ?>"
                                           readonly>
                                    <small class="text-muted">El código no se puede modificar.</small>
                                </div>
 
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del equipo</label>
                                    <input type="text"
                                           class="form-control <?= isset($errores['nombre']) ? 'is-invalid' : '' ?>"
                                           id="nombre"
                                           name="nombre"
                                           value="<?= htmlspecialchars($datos['nombre'] ?? $equipo['nombre']) ?>"
                                           required>
                                    <?php if (isset($errores['nombre'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errores['nombre']) ?></div>
                                    <?php endif; ?>
                                </div>
 
                                <div class="mb-3">
                                    <label for="id_categoria" class="form-label">Tipo de equipo</label>
                                    <select class="form-select <?= isset($errores['id_categoria']) ? 'is-invalid' : '' ?>"
                                            id="id_categoria"
                                            name="id_categoria"
                                            required>
                                        <option value="">Seleccione un tipo</option>
                                        <?php foreach ($categorias as $cat): ?>
                                            <?php $seleccionado = ($datos['id_categoria'] ?? $equipo['id_categoria']) == $cat['id_categoria']; ?>
                                            <option value="<?= $cat['id_categoria'] ?>" <?= $seleccionado ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($cat['nombre']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($errores['id_categoria'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errores['id_categoria']) ?></div>
                                    <?php endif; ?>
                                </div>
 
                                <div class="mb-3">
                                    <label for="marca" class="form-label">Marca</label>
                                    <input type="text"
                                           class="form-control <?= isset($errores['marca']) ? 'is-invalid' : '' ?>"
                                           id="marca"
                                           name="marca"
                                           value="<?= htmlspecialchars($datos['marca'] ?? $equipo['marca']) ?>"
                                           required>
                                    <?php if (isset($errores['marca'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errores['marca']) ?></div>
                                    <?php endif; ?>
                                </div>
 
                                <div class="mb-3">
                                    <label for="marcamodelo" class="form-label">Modelo</label>
                                    <input type="text"
                                           class="form-control <?= isset($errores['marcamodelo']) ? 'is-invalid' : '' ?>"
                                           id="marcamodelo"
                                           name="marcamodelo"
                                           value="<?= htmlspecialchars($datos['marcamodelo'] ?? $equipo['marcamodelo']) ?>"
                                           required>
                                    <?php if (isset($errores['marcamodelo'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errores['marcamodelo']) ?></div>
                                    <?php endif; ?>
                                </div>
 
                                <div class="mb-3">
                                    <label for="numero_serie" class="form-label">Número de Serie</label>
                                    <input type="text"
                                           class="form-control <?= isset($errores['numero_serie']) ? 'is-invalid' : '' ?>"
                                           id="numero_serie"
                                           name="numero_serie"
                                           value="<?= htmlspecialchars($datos['numero_serie'] ?? $equipo['numero_serie']) ?>"
                                           required>
                                    <?php if (isset($errores['numero_serie'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errores['numero_serie']) ?></div>
                                    <?php endif; ?>
                                </div>
 
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select <?= isset($errores['estado']) ? 'is-invalid' : '' ?>"
                                            id="estado"
                                            name="estado"
                                            required>
                                        <option value="">Seleccione un estado</option>
                                        <?php
                                        $estadoActual = $datos['estado'] ?? $equipo['estado'];
                                        $estados = ['disponible' => 'Disponible', 'prestado' => 'Prestado', 'en reparacion' => 'En reparación'];
                                        foreach ($estados as $val => $label):
                                        ?>
                                            <option value="<?= $val ?>" <?= $estadoActual === $val ? 'selected' : '' ?>>
                                                <?= $label ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($errores['estado'])): ?>
                                        <div class="invalid-feedback"><?= htmlspecialchars($errores['estado']) ?></div>
                                    <?php endif; ?>
                                </div>
 
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar cambios
                                    </button>
                                    <a href="equipos.php" class="btn btn-secondary mt-2">
                                        Volver al inventario
                                    </a>
                                </div>
 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
 
<footer>
    <p class="text-center">&copy; 2026 Sistema de prestamo de equipos</p>
</footer>
 
</body>
</html>