<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/DevolucionController.php';

$userController = new UserController();
$devController = new DevolucionController();

$action = $_GET['action'] ?? 'usuarios';

switch ($action) {
    case 'usuarios': $userController->index(); break;
    case 'registrar': $userController->formularioRegistro(); break;
    case 'guardar': $userController->guardar(); break;
    case 'eliminar_usuario': $userController->eliminar(); break;
    case 'devoluciones': $devController->index(); break;
    case 'procesar_devolucion': $devController->procesar(); break;
    default: $userController->index(); break;
}