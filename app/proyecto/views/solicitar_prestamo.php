<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Prestamo</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Formulario de Prestamo</h2>
                            <p class="text-muted mb-0">Complete los datos para registrar una solicitud de prestamo.</p>
                        </div>

                        <form id="formPrestamo">
                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">Usuario</label>
                                <select class="form-select" id="id_usuario" name="id_usuario" required>
                                    <option value="">Seleccione un usuario</option>
                                    <?php foreach ($usuarios as $u): ?>
                                        <option value="<?= $u['id_usuarios'] ?>">
                                            <?= htmlspecialchars($u['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_equipo" class="form-label">Equipo disponible</label>
                                <select class="form-select" id="id_equipo" name="id_equipo" required>
                                    <option value="">Seleccione un equipo</option>
                                    <?php foreach ($equipos as $e): ?>
                                        <option value="<?= $e['id_equipo'] ?>">
                                            <?= htmlspecialchars($e['nombre'] . ' - ' . $e['marca']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fechaPrestamo" class="form-label">Fecha de prestamo</label>
                                    <input type="date" class="form-control" id="fechaPrestamo" name="fechaPrestamo" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fechaDevolucion" class="form-label">Fecha de devolucion</label>
                                    <input type="date" class="form-control" id="fechaDevolucion" name="fechaDevolucion" required>
                                </div>
                            </div>

                            <div id="mensajePrestamo" class="mt-2"></div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-journal-check"></i> Registrar prestamo
                                </button>
                                <a href="index.php?action=prestamos" class="btn btn-outline-dark">
                                    Volver al modulo de prestamos
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Indicaciones</h5>
                        <ul class="mb-0">
                            <li>Seleccione un usuario registrado en el sistema.</li>
                            <li>Escoja un equipo disponible para prestamo.</li>
                            <li>La fecha de devolucion debe ser posterior a la fecha de prestamo.</li>
                            <li>Verifique la informacion antes de registrar la solicitud.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-5 p-3 text-center border-top"><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>

    <script src="public/js/solicitar_prestamo.js"></script>
</body>
</html>