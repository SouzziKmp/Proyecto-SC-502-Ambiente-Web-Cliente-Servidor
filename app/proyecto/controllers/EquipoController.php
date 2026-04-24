<?php
require_once __DIR__ . '/../models/EquipoModel.php';

class EquipoController {

    private EquipoModel $model;

    public function __construct() {
        $this->model = new EquipoModel();
    }

    // GET → lista
    public function index(): void {
        $equipos    = $this->model->obtenerTodos();
        $categorias = $this->model->obtenerCategorias();
        require __DIR__ . '/../views/equipos.php';
    }

    // GET → formulario vacío
    public function mostrarRegistrar(): void {
        $categorias = $this->model->obtenerCategorias();
        $errores    = [];
        $datos      = [];
        require __DIR__ . '/../views/registrar.php';
    }

    // POST → procesar registro
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
        header('Location: equipos.php?registrado=1');
        exit;
    }

    // GET → formulario con datos cargados
    public function mostrarEditar(): void {
        $id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $equipo = $this->model->obtenerPorId($id);

        if (!$equipo) {
            header('Location: equipos.php?error=no_encontrado');
            exit;
        }

        $categorias = $this->model->obtenerCategorias();
        $errores    = [];
        $datos      = $equipo; // Pre-llenar con datos actuales
        require __DIR__ . '/../views/editar.php';
    }

    // POST → procesar edición
    public function editar(): void {
        $id     = isset($_POST['id_equipo']) ? (int)$_POST['id_equipo'] : 0;
        $equipo = $this->model->obtenerPorId($id);

        if (!$equipo) {
            header('Location: equipos.php?error=no_encontrado');
            exit;
        }

        $datos   = $this->sanitizar($_POST);
        $errores = $this->validar($datos, esEdicion: true);

        if (!empty($errores)) {
            $categorias = $this->model->obtenerCategorias();
            $datos      = array_merge($equipo, $datos); // mantener id_equipo etc.
            require __DIR__ . '/../views/editar.php';
            return;
        }

        $this->model->editar($id, $datos);
        header('Location: equipos.php?editado=1');
        exit;
    }

    // POST → eliminar
    public function eliminar(): void {
        $id = isset($_POST['id_equipo']) ? (int)$_POST['id_equipo'] : 0;

        if (!$id) {
            header('Location: equipos.php?error=id_invalido');
            exit;
        }

        $this->model->eliminar($id);
        header('Location: equipos.php?eliminado=1');
        exit;
    }

    // ─── Helpers ────────────────────────────────────────────────────

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

        if (!$esEdicion) {
            if (empty($datos['codigo_inventario'])) {
                $errores['codigo_inventario'] = 'El código del equipo es obligatorio.';
            } elseif (!preg_match('/^[a-zA-Z0-9\-_]+$/', $datos['codigo_inventario'])) {
                $errores['codigo_inventario'] = 'Solo letras, números, guiones y guiones bajos.';
            }
        }

        if (empty($datos['nombre'])) {
            $errores['nombre'] = 'El nombre del equipo es obligatorio.';
        }

        if (empty($datos['id_categoria'])) {
            $errores['id_categoria'] = 'Debe seleccionar un tipo de equipo.';
        }

        if (empty($datos['marca'])) {
            $errores['marca'] = 'La marca es obligatoria.';
        } elseif (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.]+$/u', $datos['marca'])) {
            $errores['marca'] = 'Solo puede contener letras, espacios y guiones.';
        }

        if (empty($datos['marcamodelo'])) {
            $errores['marcamodelo'] = 'El modelo es obligatorio.';
        }

        if (empty($datos['numero_serie'])) {
            $errores['numero_serie'] = 'El número de serie es obligatorio.';
        } elseif (!preg_match('/^[a-zA-Z0-9\-]+$/', $datos['numero_serie'])) {
            $errores['numero_serie'] = 'Solo letras, números y guiones.';
        }

        if (empty($datos['estado'])) {
            $errores['estado'] = 'Debe seleccionar un estado.';
        }

        return $errores;
    }
}