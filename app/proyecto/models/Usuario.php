<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function listarTodos() {
        $query = "SELECT id_usuarios, nombre, email, tipo_usuario, estado FROM Usuarios";
        $resultado = $this->db->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function guardarNuevo($nombre, $cedula, $email, $tipo) {
        $stmt = $this->db->prepare("INSERT INTO Usuarios (nombre, cedula, email, tipo_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $cedula, $email, $tipo);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM Usuarios WHERE id_usuarios = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}