<?php
require_once __DIR__ . '/../config/database.php';

class AuthController {

    public function mostrarLogin() {
        include __DIR__ . '/../views/login.php';
    }

    public function login() {
        // Limpiar cualquier salida accidental de PHP (espacios o advertencias)
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (session_status() === PHP_SESSION_NONE) session_start();

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $dbObj = new Database();
            $db = $dbObj->connect();

            // Consulta exacta para Administrador
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
                echo json_encode(["status" => "error", "message" => "Credenciales incorrectas o cuenta inactiva"]);
            }
            $db->close();
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
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}