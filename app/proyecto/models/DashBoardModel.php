<?php
require_once __DIR__ . '/../config/database.php';

class Dashboard {
    private $db;

    public function __construct() {
        $dbObj = new Database();
        $this->db = $dbObj->connect();
    }

    public function obtenerEstadisticas() {
        $stats = ['total_equipos' => 0, 'prestados' => 0, 'lista_prestamos' => []];

        // Total equipos
        $res = $this->db->query("SELECT COUNT(*) as total FROM Equipos_Inventario");
        $stats['total_equipos'] = $res->fetch_assoc()['total'] ?? 0;

        // Equipos prestados
        $res = $this->db->query("SELECT COUNT(*) as total FROM Equipos_Inventario WHERE estado = 'prestado'");
        $stats['prestados'] = $res->fetch_assoc()['total'] ?? 0;

        // Listado de préstamos activos
        $sql = "SELECT e.nombre as equipo, u.nombre as usuario, p.fecha_prestamo, p.estado 
                FROM Prestamos p 
                JOIN Usuarios u ON p.id_usuario = u.id_usuarios 
                JOIN Detalle_Prestamo dp ON p.id_prestamo = dp.id_prestamo
                JOIN Equipos_Inventario e ON dp.id_equipo = e.id_equipo
                WHERE p.estado = 'activo'";
        
        $res = $this->db->query($sql);
        $stats['lista_prestamos'] = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

        return $stats;
    }
}