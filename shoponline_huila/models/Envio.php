<?php

class Envio {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Crear un envío
    public function create($id_pedido, $id_empleado, $direccion_envio) {
        $sql = "INSERT INTO envios (id_pedido, id_empleado, direccion_envio, estado_envio) 
                VALUES (?, ?, ?, 'preparando')";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_pedido, $id_empleado, $direccion_envio]);
    }
    
    // Obtener envío de un pedido
    public function getByPedido($id_pedido) {
        $sql = "SELECT e.*, emp.nombre, emp.apellido, emp.cargo 
                FROM envios e 
                JOIN empleados emp ON e.id_empleado = emp.id_empleado
                WHERE e.id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_pedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Actualizar estado del envío
    public function updateEstado($id_envio, $estado) {
        $sql = "UPDATE envios SET estado_envio = ?, fecha_envio = CURDATE() WHERE id_envio = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$estado, $id_envio]);
    }
}
?>