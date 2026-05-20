<?php

class Pago {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Registrar un pago
    public function create($id_pedido, $metodo_pago, $valor_pago) {
        $sql = "INSERT INTO pagos (id_pedido, metodo_pago, valor_pago) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_pedido, $metodo_pago, $valor_pago]);
    }
    
    // Obtener pago de un pedido
    public function getByPedido($id_pedido) {
        $sql = "SELECT * FROM pagos WHERE id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_pedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>