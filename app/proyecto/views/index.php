<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Sistema de Préstamos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/Index.css">

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

    <main class="container my-5">
        <section class="card shadow-sm border-0 p-4">
            <div class="row align-items-center">
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <img src="../img/computadoras_accesorios.jpg" alt="Equipos" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-8">
                    <h2 class="fw-bold text-dark">Simplifique el proceso de préstamos de equipos.</h2>
                    <h4 class="text-primary mb-4">No pierda nunca un equipo prestado.</h4>
                    
                    <div class="bg-light p-3 rounded">
                        <p class="fw-semibold">Algunas indicaciones a tener en cuenta:</p>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent border-0 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                Se entregará equipos únicamente a los usuarios registrados.
                            </li>
                            <li class="list-group-item bg-transparent border-0 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                Solicitud de préstamos mediante formulario digital.
                            </li>
                            <li class="list-group-item bg-transparent border-0 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                Vea sus préstamos activos en la sección "Préstamos".
                            </li>
                            <li class="list-group-item bg-transparent border-0 d-flex align-items-start text-danger fw-bold">
                                <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
                                Evite daños o pérdidas para prevenir infracciones económicas.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="text-center py-4 bg-white border-top mt-auto">
        <p class="text-muted m-0 small">&copy; 2026 Sistema de préstamo de equipos</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/index.js"></script>
</body>
</html>