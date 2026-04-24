<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
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
    <section class="registrarEquipo mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <h1 class="text-center mb-4 h2 fw-bold">Registro de Usuarios</h1>

                            <form method="POST" action="index.php?action=guardar_usuario">
                                
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-semibold">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="mb-3">
                                    <label for="cedula" class="form-label fw-semibold">Cédula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                                </div>

                                <div class="mb-3">
                                    <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required>
                                </div>

                                <div class="mb-3">
                                    <label for="rol" class="form-label fw-semibold">Rol del Sistema</label>
                                    <select class="form-select" id="rol" name="rol" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="Admin">Administrador</option>
                                        <option value="Docente">Docente</option>
                                        <option value="Estudiante">Estudiante</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Registrar Usuario</button>
                                    <a href="index.php?action=usuarios" class="btn btn-secondary mt-2">
                                        Volver a la lista
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

<footer class="mt-5 p-3 text-center border-top">
    <p>&copy; 2026 Sistema de préstamo de equipos</p>
</footer>

</body>
</html>