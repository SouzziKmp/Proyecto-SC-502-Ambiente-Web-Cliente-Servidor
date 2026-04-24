<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/EquipoController.php';
require_once __DIR__ . '/controllers/PrestamoController.php';
require_once __DIR__ . '/controllers/DevolucionController.php';

$authController     = new AuthController();
$userController     = new UserController();
$equipoController   = new EquipoController();
$prestamoController = new PrestamoController();
$devController      = new DevolucionController();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $authController->mostrarLogin();
        break;
    case 'validar_login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
        $authController->mostrarDashboard();
        break;
    case 'usuarios':
        $userController->index();
        break;
    case 'registrar_usuario':
        $userController->formularioRegistro();
        break;
    case 'equipos':
        $equipoController->index();
        break;
    case 'registrar_equipo':
        $equipoController->mostrarRegistrar();
        break;
    case 'guardar_equipo':
        $equipoController->registrar();
        break;
    case 'editar_equipo':
        $equipoController->mostrarEditar();
        break;
    case 'actualizar_equipo':
        $equipoController->editar();
        break;
    case 'eliminar_equipo':
        $equipoController->eliminar();
        break;
    case 'prestamos':
        $prestamoController->index();
        break;
    case 'solicitar_prestamo':
        $prestamoController->formulario();
        break;
    case 'mis_prestamos':
        $prestamoController->misPrestamos();
        break;
    case 'guardar_prestamo':
        $prestamoController->guardar();
        break;
    case 'devoluciones':
        $devController->index();
        break;
    case 'procesar_devolucion':
        $devController->procesar();
        break;
    default:
        $authController->mostrarDashboard();
        break;
}