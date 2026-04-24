<?php
require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function listarTodos()
    {
        $query = "SELECT id_usuarios, nombre, cedula, email, tipo_usuario, estado FROM Usuarios WHERE estado = 'activo'";
        $resultado = $this->db->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function guardarNuevo($nombre, $cedula, $email, $tipo)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO Usuarios (nombre, cedula, email, tipo_usuario) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $cedula, $email, $tipo);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) return false;
            throw $e;
        }
    }

    public function eliminar($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Usuarios WHERE id_usuarios = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1451) return "has_loans";
            throw $e;
        }
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Usuarios WHERE id_usuarios = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar($id, $nombre, $cedula, $email, $tipo)
    {
        try {
            $stmt = $this->db->prepare("UPDATE Usuarios SET nombre = ?, cedula = ?, email = ?, tipo_usuario = ? WHERE id_usuarios = ?");
            $stmt->bind_param("ssssi", $nombre, $cedula, $email, $tipo, $id);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) return false;
            throw $e;
        }
    }
}