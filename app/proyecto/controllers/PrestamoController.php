<?php
require_once __DIR__ . '/../models/PrestamoModel.php';

class PrestamoController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new PrestamoModel();
    }

    private function verificarSesion() {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function index() {
        $this->verificarSesion();
        $resumen = $this->model->obtenerResumen();
        require_once __DIR__ . '/../views/prestamo.php';
    }

    public function misPrestamos() {
        $this->verificarSesion();
        $prestamos = $this->model->obtenerTodos();
        require_once __DIR__ . '/../views/mis_prestamos.php';
    }

    public function formulario() {
        $this->verificarSesion();
        $usuarios = $this->model->obtenerUsuarios();
        $equipos  = $this->model->obtenerEquiposDisponibles();
        require_once __DIR__ . '/../views/solicitar_prestamo.php';
    }

    public function guardar() {
        $this->verificarSesion();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = (int) $_POST['id_usuario'];
            $id_equipo  = (int) $_POST['id_equipo'];
            $fecha_prestamo = $_POST['fechaPrestamo'];
            $fecha_devo     = $_POST['fechaDevolucion'];

            if ($this->model->registrar($id_usuario, $fecha_prestamo, $fecha_devo, $id_equipo)) {
                echo "success";
            } else {
                echo "error";
            }
            exit;
        }
    }
}