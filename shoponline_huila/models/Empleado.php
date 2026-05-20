<?php

class Empleado {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Obtener todos los empleados
    public function getAll() {
        $sql = "SELECT * FROM empleados ORDER BY id_empleado DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener empleado por ID
    public function getById($id) {
        $sql = "SELECT * FROM empleados WHERE id_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Crear empleado
    public function create($data) {
        $sql = "INSERT INTO empleados (nombre, apellido, cargo, salario, fecha_ingreso) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['cargo'],
            $data['salario'],
            $data['fecha_ingreso']
        ]);
    }
    
    // Actualizar empleado
    public function update($id, $data) {
        $sql = "UPDATE empleados SET nombre=?, apellido=?, cargo=?, salario=?, fecha_ingreso=? 
                WHERE id_empleado=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['cargo'],
            $data['salario'],
            $data['fecha_ingreso'],
            $id
        ]);
    }
    
    // Eliminar empleado
    public function delete($id) {
        $sql = "DELETE FROM empleados WHERE id_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>