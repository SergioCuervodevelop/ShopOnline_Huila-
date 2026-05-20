<?php

class DetallePedido {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Agregar un producto al pedido
    public function create($id_pedido, $id_producto, $cantidad, $precio_unitario, $subtotal) {
        $sql = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_pedido, $id_producto, $cantidad, $precio_unitario, $subtotal]);
    }
    
    // Obtener productos de un pedido
    public function getByPedido($id_pedido) {
        $sql = "SELECT dp.*, p.nombre, p.precio 
                FROM detalle_pedido dp 
                JOIN productos p ON dp.id_producto = p.id_producto
                WHERE dp.id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_pedido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>