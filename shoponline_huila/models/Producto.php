<?php

class Producto {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Obtener todos los productos con el nombre de su categoría
    public function getAll() {
        $sql = "SELECT p.*, c.nombre_categoria 
                FROM productos p 
                JOIN categorias c ON p.id_categoria = c.id_categoria
                ORDER BY p.id_producto DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener un producto por ID
    public function getById($id) {
        $sql = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Crear producto
    public function create($data) {
        $sql = "INSERT INTO productos (nombre, precio, stock, id_categoria) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['precio'],
            $data['stock'],
            $data['id_categoria']
        ]);
    }
    
    // Actualizar producto
    public function update($id, $data) {
        $sql = "UPDATE productos SET nombre=?, precio=?, stock=?, id_categoria=? 
                WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['precio'],
            $data['stock'],
            $data['id_categoria'],
            $id
        ]);
    }
    
    // Eliminar producto
    public function delete($id) {
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    // Reducir stock cuando se vende un producto
    public function updateStock($id, $cantidadVendida) {
        $sql = "UPDATE productos SET stock = stock - ? WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$cantidadVendida, $id]);
    }
}
?>