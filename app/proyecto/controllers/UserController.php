<?php
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    private $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->userModel = new Usuario();
    }

    private function verificarSesion() {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function index() {
        $this->verificarSesion();
        $usuarios = $this->userModel->listarTodos();
        require_once __DIR__ . '/../views/usuarios.php';
    }

    public function formularioRegistro() {
        $this->verificarSesion();
        require_once __DIR__ . '/../views/registrar_usuario.php';
    }

    public function guardar() {
        $this->verificarSesion();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $cedula = $_POST['cedula'];
            $email = $_POST['correo'];
            $tipo = $_POST['rol'];
            if ($this->userModel->guardarNuevo($nombre, $cedula, $email, $tipo)) {
                echo "success";
            } else {
                echo "error";
            }
            exit;
        }
    }

    public function eliminar() {
        $this->verificarSesion();
        if (isset($_GET['id'])) {
            $this->userModel->eliminar($_GET['id']);
            header("Location: index.php?action=usuarios");
            exit;
        }
    }
}