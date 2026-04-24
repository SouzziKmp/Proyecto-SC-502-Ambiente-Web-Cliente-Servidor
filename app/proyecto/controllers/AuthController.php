<?php
require_once __DIR__ . '/../config/database.php';

class AuthController {

    public function mostrarLogin() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        // Si ya está logueado, mandarlo al dashboard directamente
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

        require_once __DIR__ . '/../models/DashBoardModel.php';
        $modelo = new Dashboard(); 
        $datos = $modelo->obtenerEstadisticas();

        include __DIR__ . '/../views/dashboard.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}