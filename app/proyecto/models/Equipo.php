<?php
require_once __DIR__ . '/../config/database.php';

class Equipo {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function registrarDevolucion($codigo, $estadoEntrega) {
        $hoy = date('Y-m-d');
        
        $estadoInv = 'disponible';
        if ($estadoEntrega === 'con_danos') {
            $estadoInv = 'mantenimiento';
        } elseif ($estadoEntrega === 'en prestamo') {
            $estadoInv = 'prestado';
        }

        $stmtInv = $this->db->prepare("UPDATE Equipos_Inventario SET estado = ? WHERE codigo_inventario = ?");
        $stmtInv->bind_param("ss", $estadoInv, $codigo);
        $stmtInv->execute();

        $fechaDevo = ($estadoEntrega === 'en prestamo') ? null : $hoy;
        $estadoPres = ($estadoEntrega === 'en prestamo') ? 'activo' : 'devuelto';

        $sql = "UPDATE Prestamos SET fecha_devo_real = ?, estado = ? 
                WHERE id_prestamo = (
                    SELECT id_prestamo FROM Detalle_Prestamo dp
                    JOIN Equipos_Inventario e ON dp.id_equipo = e.id_equipo
                    WHERE e.codigo_inventario = ? ORDER BY dp.id_prestamo DESC LIMIT 1
                )";
        
        $stmtPres = $this->db->prepare($sql);
        $stmtPres->bind_param("sss", $fechaDevo, $estadoPres, $codigo);
        $stmtPres->execute();
        
        return $this->db->affected_rows > 0;
    }

    public function obtenerHistorialReciente() {
        $query = "SELECT u.nombre as usuario, e.codigo_inventario, e.nombre as equipo, 
                         p.fecha_prestamo, p.fecha_devo_real, p.estado 
                  FROM Prestamos p
                  JOIN Usuarios u ON p.id_usuario = u.id_usuarios
                  JOIN Detalle_Prestamo dp ON p.id_prestamo = dp.id_prestamo
                  JOIN Equipos_Inventario e ON dp.id_equipo = e.id_equipo
                  ORDER BY p.id_prestamo DESC LIMIT 10";
        $resultado = $this->db->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}