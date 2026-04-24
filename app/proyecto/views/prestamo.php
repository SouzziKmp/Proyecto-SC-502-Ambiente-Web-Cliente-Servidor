<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <main class="container py-5">
        <section class="mb-5">
            <div class="row align-items-center g-4">
                <div class="col-md-7">
                    <h2 class="fw-bold mb-3">Modulo de Prestamos</h2>
                    <p class="text-muted mb-4">
                        En esta seccion se puede gestionar la solicitud y consulta de prestamos de equipos tecnologicos de forma ordenada y sencilla.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="index.php?action=solicitar" class="btn btn-primary px-4">
                            <i class="bi bi-journal-plus"></i> Solicitar prestamo
                        </a>
                        <a href="index.php?action=mis_prestamos" class="btn btn-outline-dark px-4">
                            <i class="bi bi-list-check"></i> Ver prestamos activos
                        </a>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card shadow border-0">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Resumen rapido</h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Equipos disponibles</span>
                                    <span class="fw-bold text-success"><?= $resumen['disponibles'] ?></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Prestamos activos</span>
                                    <span class="fw-bold text-primary"><?= $resumen['activos'] ?></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Prestamos por vencer</span>
                                    <span class="fw-bold text-warning"><?= $resumen['por_vencer'] ?></span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <span>Devoluciones pendientes</span>
                                    <span class="fw-bold text-danger"><?= $resumen['pendientes'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow h-100 border-0">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Solicitar un prestamo</h4>
                            <p class="text-muted">Complete un formulario con el usuario, equipo y fechas correspondientes para registrar una nueva solicitud.</p>
                            <a href="index.php?action=solicitar" class="btn btn-primary">Ir al formulario</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow h-100 border-0">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Consultar prestamos activos</h4>
                            <p class="text-muted">Revise el listado de prestamos activos para dar seguimiento a los equipos actualmente asignados.</p>
                            <a href="index.php?action=mis_prestamos" class="btn btn-dark">Ver listado</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="mt-5 p-3 text-center border-top"><p>&copy; 2026 Sistema de préstamo de equipos</p></footer>
</body>
</html>