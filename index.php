<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/DevolucionController.php';
require_once __DIR__ . '/../controllers/PrestamoController.php';

$userController     = new UserController();
$devController      = new DevolucionController();
$prestamoController = new PrestamoController();

$action = $_GET['action'] ?? 'prestamos';

switch ($action) {
    case 'usuarios':          $userController->index(); break;
    case 'registrar':         $userController->formularioRegistro(); break;
    case 'guardar':           $userController->guardar(); break;
    case 'eliminar_usuario':  $userController->eliminar(); break;
    case 'devoluciones':      $devController->index(); break;
    case 'procesar_devolucion': $devController->procesar(); break;
    case 'prestamos':         $prestamoController->index(); break;
    case 'mis_prestamos':     $prestamoController->misPrestamos(); break;
    case 'solicitar':         $prestamoController->formulario(); break;
    case 'guardar_prestamo':  $prestamoController->guardar(); break;
    default:                  $prestamoController->index(); break;
}