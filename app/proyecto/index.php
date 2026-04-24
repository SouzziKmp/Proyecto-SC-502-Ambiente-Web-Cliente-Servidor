<?php
// 1. INICIAR SESIÓN: Debe ser lo primero para no perder la sesión entre páginas
session_start();

// 2. CONFIGURACIÓN DE ERRORES (Opcional, útil para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 3. IMPORTAR CONTROLADORES
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/EquipoController.php';
require_once __DIR__ . '/controllers/PrestamoController.php';
require_once __DIR__ . '/controllers/DevolucionController.php';

// 4. INSTANCIAR CONTROLADORES
$authController     = new AuthController();
$userController     = new UserController();
$equipoController   = new EquipoController();
$prestamoController = new PrestamoController();
$devController      = new DevolucionController();

// 5. CAPTURAR LA ACCIÓN DE LA URL (Ej: index.php?action=dashboard)
$action = $_GET['action'] ?? 'login';

// 6. ENRUTADOR (SWITCH)
switch ($action) {
    
    // --- AUTENTICACIÓN ---
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
        // El controlador debe verificar si hay sesión activa antes de cargar
        $authController->mostrarDashboard();
        break;

    // --- MÓDULO DE USUARIOS ---
    case 'usuarios':
        $userController->index();
        break;

    case 'registrar_usuario':
        $userController->formularioRegistro();
        break;

    // --- MÓDULO DE EQUIPOS ---
    case 'equipos':
        $equipoController->index();
        break;

    case 'registrar_equipo':
        $equipoController->mostrarRegistrar();
        break;

    // --- MÓDULO DE PRÉSTAMOS ---
    case 'prestamos':
        $prestamoController->index();
        break;

    case 'nuevo_prestamo':
        $prestamoController->crear();
        break;

    // --- MÓDULO DE DEVOLUCIONES ---
    case 'devoluciones':
        $devController->index();
        break;

    // --- RUTA POR DEFECTO ---
    default:
        $authController->mostrarLogin();
        break;
}