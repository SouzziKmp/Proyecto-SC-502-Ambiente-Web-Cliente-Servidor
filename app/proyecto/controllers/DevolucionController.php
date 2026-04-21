<?php
require_once __DIR__ . '/../models/Equipo.php';

class DevolucionController {
    private $equipoModel;

    public function __construct() {
        $this->equipoModel = new Equipo();
    }

    public function index() {
        $historial = $this->equipoModel->obtenerHistorialReciente();
        require_once __DIR__ . '/../views/admin/devoluciones.php';
    }

    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = trim($_POST['codigo_equipo']);
            $estado = $_POST['estado_entrega'];
            if ($this->equipoModel->registrarDevolucion($codigo, $estado)) {
                echo "success";
            } else {
                echo "error";
            }
            exit;
        }
    }
}