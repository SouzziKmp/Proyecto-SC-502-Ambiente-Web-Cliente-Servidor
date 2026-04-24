<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="public/css/usuarios.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar bg-dark border-bottom border-body p-3" data-bs-theme="dark">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="h4 text-white m-0">Sistema de préstamo de equipo</h1>
                <ul class="d-flex align-items-center list-unstyled m-0 gap-3">
                    <li><a href="index.php?action=usuarios" class="nav-link active">Usuarios</a></li>
                    <li><a href="index.php?action=devoluciones" class="nav-link">Devoluciones</a></li>
                    <li><a href="index.php?action=equipos" class="nav-link">Equipos</a></li>
                    <li><a href="index.php?action=prestamos" class="nav-link">Préstamos</a></li>
                    <li><a href="login.html" class="btn btn-secondary">Cerrar sesión <i class="bi bi-box-arrow-in-right"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container mt-5">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <a href="index.php?action=registrar" class="btn btn-success">
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
                                <th>Nombre</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaUsuarios">
                            <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nombre']) ?></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= htmlspecialchars($u['tipo_usuario']) ?></td>
                                <td><span class="badge bg-success"><?= htmlspecialchars($u['estado']) ?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>
    <script src="public/js/usuarios.js"></script>
</body>
</html>