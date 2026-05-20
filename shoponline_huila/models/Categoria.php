<?php

class Categoria {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Obtener todas las categorías
    public function getAll() {
        $sql = "SELECT * FROM categorias ORDER BY nombre_categoria";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener una categoría por ID
    public function getById($id) {
        $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Crear categoría
    public function create($nombre) {
        $sql = "INSERT INTO categorias (nombre_categoria) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre]);
    }
}
?>