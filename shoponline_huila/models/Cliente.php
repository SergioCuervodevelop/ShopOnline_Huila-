<?php
class Cliente {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM clientes ORDER BY id_cliente DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $sql = "INSERT INTO clientes (nombre, apellido, correo, telefono, direccion) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['nombre'], $data['apellido'], $data['correo'], $data['telefono'], $data['direccion']]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE clientes SET nombre=?, apellido=?, correo=?, telefono=?, direccion=? WHERE id_cliente=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['nombre'], $data['apellido'], $data['correo'], $data['telefono'], $data['direccion'], $id]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id_cliente = ?");
        return $stmt->execute([$id]);
    }
}
?>