<?php
require_once __DIR__ . '/../models/Equipo.php';

class DevolucionController {
    private $equipoModel;

    public function __construct() {
        $this->equipoModel = new Equipo();
    }

    private function verificarSesion() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['admin_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function index() {
        $this->verificarSesion();
        $historial = $this->equipoModel->obtenerHistorialReciente();
        require_once __DIR__ . '/../views/devoluciones.php';
    }

    public function procesar() {
        $this->verificarSesion();
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