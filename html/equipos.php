<?php

 
require_once __DIR__ . '/../controllers/EquipoController.php';
 
$controller = new EquipoController();
$accion     = $_GET['accion'] ?? 'index';
 
match(true) {
    $accion === 'registrar' && $_SERVER['REQUEST_METHOD'] === 'POST' => $controller->registrar(),
    $accion === 'registrar'                                          => $controller->mostrarRegistrar(),
    $accion === 'editar'    && $_SERVER['REQUEST_METHOD'] === 'POST' => $controller->editar(),
    $accion === 'editar'                                             => $controller->mostrarEditar(),
    $accion === 'eliminar'  && $_SERVER['REQUEST_METHOD'] === 'POST' => $controller->eliminar(),
    default                                                          => $controller->index(),
};
 