<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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

<main class="container mt-5">
    <h1 class="text-center mb-4 h2 fw-bold">Lista de Usuarios</h1>
    
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <a href="index.php?action=registrar_usuario" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Registrar nuevo usuario
        </a>
        <input type="text" id="busqueda" class="form-control w-25" placeholder="Buscar usuario...">
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaUsuarios">
                        <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td class="ps-3 fw-bold"><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['tipo_usuario']) ?></td>
                            <td>
                                <span class="badge bg-success"><?= htmlspecialchars($u['estado'] ?? 'Activo') ?></span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?action=editar_usuario&id=<?= $u['id_usuarios'] ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="index.php?action=eliminar_usuario&id=<?= $u['id_usuarios'] ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<footer class="mt-5 p-3 text-center border-top">
    <p>&copy; 2026 Sistema de préstamo de equipos</p>
</footer>

</body>
</html>