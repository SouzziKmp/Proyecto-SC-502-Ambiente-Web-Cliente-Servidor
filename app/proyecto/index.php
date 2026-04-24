<?php
// index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/DevolucionController.php';
require_once __DIR__ . '/controllers/PrestamoController.php';
require_once __DIR__ . '/controllers/EquipoController.php';

$userController     = new UserController();
$devController      = new DevolucionController();
$prestamoController = new PrestamoController();
$equipoController   = new EquipoController();

$action = $_GET['action'] ?? 'prestamos';

switch ($action) {
    // USUARIOS
    case 'usuarios':           
        $userController->index(); 
        break;
    case 'registrar_usuario':          
        $userController->formularioRegistro(); 
        break;
    case 'guardar_usuario':            
        $userController->guardar(); 
        break;
    case 'eliminar_usuario':   
        $userController->eliminar(); 
        break;

    // EQUIPOS (INVENTARIO)
    case 'equipos':
        $equipoController->index();
        break;
    case 'registrar':
        $equipoController->mostrarRegistrar();
        break;
    case 'guardar_equipo':
        $equipoController->registrar();
        break;
    case 'editar':
        $equipoController->mostrarEditar();
        break;
    case 'actualizar':
        $equipoController->editar();
        break;
    case 'eliminar':
        $equipoController->eliminar();
        break;

    // DEVOLUCIONES
    case 'devoluciones':       
        $devController->index(); 
        break;
    case 'procesar_devolucion': 
        $devController->procesar(); 
        break;

    // PRÉSTAMOS
    case 'prestamos':          
        $prestamoController->index(); 
        break;
    case 'mis_prestamos':      
        $prestamoController->misPrestamos(); 
        break;
    case 'solicitar':          
        $prestamoController->formulario(); 
        break;
    case 'guardar_prestamo':   
        $prestamoController->guardar(); 
        break;

    default:                   
        $prestamoController->index(); 
        break;
}