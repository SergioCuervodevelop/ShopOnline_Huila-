<?php

class Pedido {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Obtener todos los pedidos con información del cliente
    public function getAllWithClientes() {
        $sql = "SELECT p.*, c.nombre, c.apellido 
                FROM pedidos p 
                JOIN clientes c ON p.id_cliente = c.id_cliente
                ORDER BY p.id_pedido DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener un pedido por ID
    public function getById($id) {
        $sql = "SELECT * FROM pedidos WHERE id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Obtener pedido con todos sus detalles (productos incluidos)
    public function getByIdWithDetails($id) {
        $sql = "SELECT p.*, c.nombre, c.apellido, c.direccion 
                FROM pedidos p 
                JOIN clientes c ON p.id_cliente = c.id_cliente
                WHERE p.id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($pedido) {
            // Obtener los productos del pedido
            $sqlDetalles = "SELECT dp.*, pr.nombre 
                           FROM detalle_pedido dp 
                           JOIN productos pr ON dp.id_producto = pr.id_producto
                           WHERE dp.id_pedido = ?";
            $stmtDetalles = $this->pdo->prepare($sqlDetalles);
            $stmtDetalles->execute([$id]);
            $pedido['detalles'] = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $pedido;
    }
    
    // Crear un nuevo pedido
    public function create($id_cliente, $total) {
        $sql = "INSERT INTO pedidos (id_cliente, total, estado) VALUES (?, ?, 'pagado')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_cliente, $total]);
        return $this->pdo->lastInsertId(); // Retorna el ID del pedido creado
    }
    
    // Actualizar estado del pedido
    public function updateEstado($id, $estado) {
        $sql = "UPDATE pedidos SET estado = ? WHERE id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$estado, $id]);
    }
}
?>