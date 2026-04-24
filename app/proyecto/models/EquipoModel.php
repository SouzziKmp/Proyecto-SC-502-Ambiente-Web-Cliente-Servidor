<?php
require_once __DIR__ . '/../config/database.php';

class EquipoModel {

    private mysqli $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

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
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function obtenerPorId(int $id): array|false {
        $stmt = $this->conn->prepare(
            "SELECT 
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
             WHERE e.id_equipo = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: false;
    }

    public function codigoExiste(string $codigo, int $excluirId = 0): bool {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) AS total FROM Equipos_Inventario 
             WHERE codigo_inventario = ? AND id_equipo != ?"
        );
        $stmt->bind_param("si", $codigo, $excluirId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return (int)$row['total'] > 0;
    }

    public function registrar(array $d): int {
        $stmt = $this->conn->prepare(
            "INSERT INTO Equipos_Inventario 
                (codigo_inventario, nombre, marca, marcamodelo, numero_serie, id_categoria, estado)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        
        $stmt->bind_param(
            "sssssis",
            $d['codigo_inventario'],
            $d['nombre'],
            $d['marca'],
            $d['marcamodelo'],
            $d['numero_serie'],
            $d['id_categoria'],
            $d['estado']
        );
        $stmt->execute();
        return (int)$this->conn->insert_id;
    }

    public function editar(int $id, array $d): bool {
        $stmt = $this->conn->prepare(
            "UPDATE Equipos_Inventario SET
                nombre       = ?,
                marca        = ?,
                marcamodelo  = ?,
                numero_serie = ?,
                id_categoria = ?,
                estado       = ?
             WHERE id_equipo = ?"
        );
        
        $stmt->bind_param(
            "ssssisi",
            $d['nombre'],
            $d['marca'],
            $d['marcamodelo'],
            $d['numero_serie'],
            $d['id_categoria'],
            $d['estado'],
            $id
        );
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function eliminar(int $id): bool {
        $stmt = $this->conn->prepare(
            "DELETE FROM Equipos_Inventario WHERE id_equipo = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function obtenerCategorias(): array {
        $result = $this->conn->query(
            "SELECT id_categoria, nombre FROM Categoria ORDER BY nombre"
        );
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}