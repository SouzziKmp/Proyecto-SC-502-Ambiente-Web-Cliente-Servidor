<?php
require_once __DIR__ . '/../models/EquipoModel.php';

class EquipoController {

    private EquipoModel $model;

    public function __construct() {
        $this->model = new EquipoModel();
    }

    public function index(): void {
        $equipos    = $this->model->obtenerTodos();
        require __DIR__ . '/../views/equipos.php';
    }

    public function mostrarRegistrar(): void {
        $categorias = $this->model->obtenerCategorias();
        $errores    = [];
        $datos      = [];
        require __DIR__ . '/../views/registrar.php';
    }

    public function registrar(): void {
        $datos   = $this->sanitizar($_POST);
        $errores = $this->validar($datos);

        if (empty($errores['codigo_inventario']) && $this->model->codigoExiste($datos['codigo_inventario'])) {
            $errores['codigo_inventario'] = "Ya existe un equipo con el código \"{$datos['codigo_inventario']}\".";
        }

        if (!empty($errores)) {
            $categorias = $this->model->obtenerCategorias();
            require __DIR__ . '/../views/registrar.php';
            return;
        }

        $this->model->registrar($datos);
        header('Location: index.php?action=equipos&registrado=1');
        exit;
    }

    public function mostrarEditar(): void {
        $id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $equipo = $this->model->obtenerPorId($id);

        if (!$equipo) {
            header('Location: index.php?action=equipos&error=no_encontrado');
            exit;
        }

        $categorias = $this->model->obtenerCategorias();
        $errores    = [];
        $datos      = $equipo;
        require __DIR__ . '/../views/editar.php';
    }

    public function editar(): void {
        $id     = isset($_POST['id_equipo']) ? (int)$_POST['id_equipo'] : 0;
        $equipo = $this->model->obtenerPorId($id);

        if (!$equipo) {
            header('Location: index.php?action=equipos&error=no_encontrado');
            exit;
        }

        $datos   = $this->sanitizar($_POST);
        $errores = $this->validar($datos, true);

        if (!empty($errores)) {
            $categorias = $this->model->obtenerCategorias();
            require __DIR__ . '/../views/editar.php';
            return;
        }

        $this->model->editar($id, $datos);
        header('Location: index.php?action=equipos&editado=1');
        exit;
    }

    public function eliminar(): void {
        $id = isset($_POST['id_equipo']) ? (int)$_POST['id_equipo'] : 0;
        if ($id > 0) {
            $this->model->eliminar($id);
            header('Location: index.php?action=equipos&eliminado=1');
        } else {
            header('Location: index.php?action=equipos&error=id_invalido');
        }
        exit;
    }

    private function sanitizar(array $post): array {
        return [
            'codigo_inventario' => trim($post['codigo_inventario'] ?? ''),
            'nombre'            => trim($post['nombre']            ?? ''),
            'marca'             => trim($post['marca']             ?? ''),
            'marcamodelo'       => trim($post['marcamodelo']       ?? ''),
            'numero_serie'      => trim($post['numero_serie']      ?? ''),
            'id_categoria'      => (int)($post['id_categoria']     ?? 0),
            'estado'            => trim($post['estado']            ?? ''),
        ];
    }

    private function validar(array $datos, bool $esEdicion = false): array {
        $errores = [];
        if (!$esEdicion && empty($datos['codigo_inventario'])) {
            $errores['codigo_inventario'] = 'El código es obligatorio.';
        }
        if (empty($datos['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }
        if (empty($datos['id_categoria'])) {
            $errores['id_categoria'] = 'Debe seleccionar un tipo.';
        }
        return $errores;
    }
}