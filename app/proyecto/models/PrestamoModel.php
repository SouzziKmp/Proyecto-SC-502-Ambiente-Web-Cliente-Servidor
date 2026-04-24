<?php
require_once __DIR__ . '/../config/database.php';

class PrestamoModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function obtenerResumen() {
        $resumen = [];

        $r = $this->conn->query("SELECT COUNT(*) as total FROM Equipos_Inventario WHERE estado = 'disponible'");
        $resumen['disponibles'] = $r->fetch_assoc()['total'];

        $r = $this->conn->query("SELECT COUNT(*) as total FROM Prestamos WHERE estado = 'activo'");
        $resumen['activos'] = $r->fetch_assoc()['total'];

        $r = $this->conn->query("SELECT COUNT(*) as total FROM Prestamos WHERE estado = 'activo' AND fecha_devo_esti <= DATE_ADD(CURDATE(), INTERVAL 2 DAY)");
        $resumen['por_vencer'] = $r->fetch_assoc()['total'];

        $r = $this->conn->query("SELECT COUNT(*) as total FROM Prestamos WHERE estado = 'activo' AND fecha_devo_esti < CURDATE()");
        $resumen['pendientes'] = $r->fetch_assoc()['total'];

        return $resumen;
    }

    public function obtenerTodos() {
        $sql = "SELECT p.id_prestamo, u.nombre AS usuario, e.nombre AS equipo,
                       p.fecha_prestamo, p.fecha_devo_esti, p.estado
                FROM Prestamos p
                INNER JOIN Usuarios u ON p.id_usuario = u.id_usuarios
                INNER JOIN Detalle_Prestamo dp ON dp.id_prestamo = p.id_prestamo
                INNER JOIN Equipos_Inventario e ON dp.id_equipo = e.id_equipo
                ORDER BY p.fecha_prestamo DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerUsuarios() {
        $result = $this->conn->query("SELECT id_usuarios, nombre FROM Usuarios WHERE estado = 'activo' ORDER BY nombre");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerEquiposDisponibles() {
        $result = $this->conn->query("SELECT id_equipo, nombre, marca FROM Equipos_Inventario WHERE estado = 'disponible' ORDER BY nombre");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function registrar($id_usuario, $fecha_prestamo, $fecha_devo_esti, $id_equipo) {
        $stmt = $this->conn->prepare(
            "INSERT INTO Prestamos (id_usuario, fecha_prestamo, fecha_devo_esti, estado) VALUES (?, ?, ?, 'activo')"
        );
        $stmt->bind_param("iss", $id_usuario, $fecha_prestamo, $fecha_devo_esti);
        if (!$stmt->execute()) return false;

        $id_prestamo = $this->conn->insert_id;

        $stmt2 = $this->conn->prepare(
            "INSERT INTO Detalle_Prestamo (id_prestamo, id_equipo) VALUES (?, ?)"
        );
        $stmt2->bind_param("ii", $id_prestamo, $id_equipo);
        if (!$stmt2->execute()) return false;

        $stmt3 = $this->conn->prepare(
            "UPDATE Equipos_Inventario SET estado = 'prestado' WHERE id_equipo = ?"
        );
        $stmt3->bind_param("i", $id_equipo);
        return $stmt3->execute();
    }
}