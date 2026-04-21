<?php
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new Usuario();
    }

    public function index() {
        $usuarios = $this->userModel->listarTodos();
        require_once __DIR__ . '/../views/admin/usuarios.php';
    }

    public function formularioRegistro() {
        require_once __DIR__ . '/../views/admin/registrar_usuario.php';
    }

    public function guardar() {
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
        if (isset($_GET['id'])) {
            $this->userModel->eliminar($_GET['id']);
            header("Location: index.php?action=usuarios");
            exit;
        }
    }
}