<?php
// models/EquipoModel.php
 
require_once __DIR__ . '/../config/database.php';
 
class EquipoModel {
 
    private PDO $pdo;
 
    public function __construct() {
        $this->pdo = getConexion();
    }
 
    // Obtener todos los equipos con su categoría
    public function obtenerTodos(): array {
        $sql = "SELECT 
                    e.id_equipo,
                    e.codigo_inventario,
                    e.nombre,
                    e.marca,
                    e.marcamodelo,
                    e.numero_serie,
                    e.estado,
                    c.id_categoria,
                    c.nombre AS categoria
                FROM Equipos_Inventario e
                INNER JOIN Categoria c ON e.id_categoria = c.id_categoria
                ORDER BY e.id_equipo DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
 
    // Obtener un equipo por su ID
    public function obtenerPorId(int $id): array|false {
        $sql = "SELECT 
                    e.id_equipo,
                    e.codigo_inventario,
                    e.nombre,
                    e.marca,
                    e.marcamodelo,
                    e.numero_serie,
                    e.estado,
                    c.id_categoria,
                    c.nombre AS categoria
                FROM Equipos_Inventario e
                INNER JOIN Categoria c ON e.id_categoria = c.id_categoria
                WHERE e.id_equipo = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
 
    // Verificar si un código ya existe (para validar duplicados)
    public function codigoExiste(string $codigo, int $excluirId = 0): bool {
        $sql = "SELECT COUNT(*) FROM Equipos_Inventario 
                WHERE codigo_inventario = :codigo AND id_equipo != :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':codigo' => $codigo, ':id' => $excluirId]);
        return (int)$stmt->fetchColumn() > 0;
    }
 
    // Registrar nuevo equipo
    public function registrar(array $datos): int {
        $sql = "INSERT INTO Equipos_Inventario 
                    (codigo_inventario, nombre, marca, marcamodelo, numero_serie, id_categoria, estado)
                VALUES 
                    (:codigo, :nombre, :marca, :modelo, :serie, :id_categoria, :estado)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':codigo'      => $datos['codigo_inventario'],
            ':nombre'      => $datos['nombre'],
            ':marca'       => $datos['marca'],
            ':modelo'      => $datos['marcamodelo'],
            ':serie'       => $datos['numero_serie'],
            ':id_categoria'=> $datos['id_categoria'],
            ':estado'      => $datos['estado'],
        ]);
        return (int)$this->pdo->lastInsertId();
    }
 
    // Editar equipo existente
    public function editar(int $id, array $datos): bool {
        $sql = "UPDATE Equipos_Inventario SET
                    nombre            = :nombre,
                    marca             = :marca,
                    marcamodelo       = :modelo,
                    numero_serie      = :serie,
                    id_categoria      = :id_categoria,
                    estado            = :estado
                WHERE id_equipo = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':marca'       => $datos['marca'],
            ':modelo'      => $datos['marcamodelo'],
            ':serie'       => $datos['numero_serie'],
            ':id_categoria'=> $datos['id_categoria'],
            ':estado'      => $datos['estado'],
            ':id'          => $id,
        ]);
        return $stmt->rowCount() > 0;
    }
 
    // Eliminar equipo
    public function eliminar(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Equipos_Inventario WHERE id_equipo = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }
 
    // Obtener todas las categorías (para el select del formulario)
    public function obtenerCategorias(): array {
        $stmt = $this->pdo->query("SELECT id_categoria, nombre FROM Categoria ORDER BY nombre");
        return $stmt->fetchAll();
    }
}