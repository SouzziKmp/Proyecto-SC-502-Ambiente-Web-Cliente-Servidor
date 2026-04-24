<?php
require_once __DIR__ . '/../models/PrestamoModel.php';

class PrestamoController {
    private $model;

    public function __construct() {
        $this->model = new PrestamoModel();
    }

    public function index() {
        $resumen = $this->model->obtenerResumen();
        require_once __DIR__ . '/../views/prestamo.php';
    }

    public function misPrestamos() {
        $prestamos = $this->model->obtenerTodos();
        require_once __DIR__ . '/../views/mis_prestamos.php';
    }

    public function formulario() {
        $usuarios = $this->model->obtenerUsuarios();
        $equipos  = $this->model->obtenerEquiposDisponibles();
        require_once __DIR__ . '/../views/solicitar_prestamo.php';
    }

    public function guardar() {
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