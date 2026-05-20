<?php

class Cliente {
    // Variable para guardar la conexión a la BD
    private $pdo;
    
    // Constructor: se ejecuta al crear un objeto de esta clase
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Obtener todos los clientes
    public function getAll() {
        $sql = "SELECT * FROM clientes ORDER BY id_cliente DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener un cliente por su ID
    public function getById($id) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Crear un nuevo cliente
    public function create($data) {
        $sql = "INSERT INTO clientes (nombre, apellido, correo, telefono, direccion) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['correo'],
            $data['telefono'],
            $data['direccion']
        ]);
    }
    
    // Actualizar un cliente existente
    public function update($id, $data) {
        $sql = "UPDATE clientes SET nombre=?, apellido=?, correo=?, telefono=?, direccion=? 
                WHERE id_cliente=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['correo'],
            $data['telefono'],
            $data['direccion'],
            $id
        ]);
    }
    
    // Eliminar un cliente
    public function delete($id) {
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>