<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="public/css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar bg-dark border-bottom border-body p-3" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="h4 text-white m-0">Sistema de préstamo de equipo</h1>
            
            <ul class="d-flex align-items-center list-unstyled m-0 gap-3">
                <li><a href="index.php?action=usuarios" class="nav-link text-white">Usuarios</a></li>
                <li><a href="index.php?action=devoluciones" class="nav-link text-white">Devoluciones</a></li>
                <li><a href="index.php?action=equipos" class="nav-link text-white">Equipos</a></li>
                <li><a href="index.php?action=prestamos" class="nav-link text-white">Préstamos</a></li>
                <li>
                    <a href="login.html" class="btn btn-secondary btn-sm py-1 d-flex align-items-center gap-2">
                        <span>Cerrar sesión</span>
                        <i class="bi bi-box-arrow-in-right" style="font-size: 1rem;"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Registro de Usuario</h1>
                        <form id="formRegistroUsuario" action="index.php?action=guardar" method="post">
                            <div class="mb-3"><label class="form-label">Nombre Completo</label><input type="text" class="form-control" name="nombre" required></div>
                            <div class="mb-3"><label class="form-label">Cédula</label><input type="text" class="form-control" name="cedula" required></div>
                            <div class="mb-3"><label class="form-label">Correo</label><input type="email" class="form-control" name="correo" required></div>
                            <div class="mb-3">
                                <label class="form-label">Rol del Sistema</label>
                                <select class="form-select" name="rol" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="Admin">Administrador</option>
                                    <option value="Docente">Docente</option>
                                    <option value="Estudiante">Estudiante</option>
                                </select>
                            </div>
                            <div class="mb-3"><label class="form-label">Contraseña</label><input type="password" class="form-control" name="password" required></div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                                <a href="index.php?action=usuarios" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="mt-5 p-3 text-center border-top"><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>
    <script src="../js/usuarios.js"></script>
</body>
</html>