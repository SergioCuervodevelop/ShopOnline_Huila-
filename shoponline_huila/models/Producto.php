<?php
class Producto {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT p.*, c.nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria ORDER BY p.id_producto DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id_producto = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $sql = "INSERT INTO productos (nombre, precio, stock, id_categoria) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['nombre'], $data['precio'], $data['stock'], $data['id_categoria']]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE productos SET nombre=?, precio=?, stock=?, id_categoria=? WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['nombre'], $data['precio'], $data['stock'], $data['id_categoria'], $id]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id_producto = ?");
        return $stmt->execute([$id]);
    }
}
?>