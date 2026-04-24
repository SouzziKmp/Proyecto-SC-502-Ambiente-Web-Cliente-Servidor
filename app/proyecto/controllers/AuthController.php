<?php
require_once __DIR__ . '/../config/database.php';

class AuthController {

    public function mostrarLogin() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (isset($_SESSION['admin_id'])) {
            header("Location: index.php?action=dashboard");
            exit;
        }
        include __DIR__ . '/../views/login.php';
    }

    public function login() {
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (session_status() === PHP_SESSION_NONE) session_start();

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $dbObj = new Database();
            $db = $dbObj->connect();

            $stmt = $db->prepare("SELECT id_admin, nombre, rol FROM Administrador WHERE email = ? AND password = ? AND estado = 'activo'");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();

            if ($user) {
                $_SESSION['admin_id'] = $user['id_admin'];
                $_SESSION['admin_nombre'] = $user['nombre'];
                $_SESSION['admin_rol'] = $user['rol'];
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Credenciales incorrectas"]);
            }
            exit;
        }
    }

    public function mostrarDashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $dbObj = new Database();
        $db = $dbObj->connect();

        // 1. Total de equipos registrados en el inventario
        $sqlTotal = "SELECT COUNT(*) as total FROM Equipos_Inventario";
        $resTotal = $db->query($sqlTotal);
        $totalEquipos = $resTotal->fetch_assoc()['total'];

        // 2. Total de equipos que están actualmente prestados
        $sqlPrestados = "SELECT COUNT(*) as total FROM Equipos_Inventario WHERE estado = 'prestado'";
        $resPrestados = $db->query($sqlPrestados);
        $totalPrestados = $resPrestados->fetch_assoc()['total'];

        // 3. Listado de préstamos activos con detalle de equipo y usuario
        // Nota: Se une con Detalle_Prestamo para saber qué equipo es
        $sqlLista = "SELECT e.nombre as equipo, u.nombre as usuario, p.fecha_prestamo, p.estado 
                     FROM Prestamos p
                     JOIN Usuarios u ON p.id_usuario = u.id_usuarios
                     JOIN Detalle_Prestamo dp ON p.id_prestamo = dp.id_prestamo
                     JOIN Equipos_Inventario e ON dp.id_equipo = e.id_equipo
                     WHERE p.estado = 'activo' 
                     ORDER BY p.fecha_prestamo DESC";
        $resLista = $db->query($sqlLista);
        
        $listaPrestamos = [];
        while ($fila = $resLista->fetch_assoc()) {
            $listaPrestamos[] = $fila;
        }

        $datos = [
            'total_equipos' => $totalEquipos,
            'prestados' => $totalPrestados,
            'lista_prestamos' => $listaPrestamos
        ];

        include __DIR__ . '/../views/dashboard.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}