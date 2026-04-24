<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistema de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="text-center fw-bold mb-4">Iniciar Sesión</h2>
                        <form id="formLogin">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Correo Electrónico</label>
                                <input type="email" id="email" class="form-control" placeholder="nombre@ejemplo.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Contraseña</label>
                                <input type="password" id="password" class="form-control" placeholder="••••••••" required>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="public/js/Auth.js"></script>
</body>
</html>