<?php
class Empleado {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM empleados ORDER BY id_empleado DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM empleados WHERE id_empleado = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $sql = "INSERT INTO empleados (nombre, apellido, cargo, salario, fecha_ingreso) VALUES (?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['nombre'], $data['apellido'], $data['cargo'], $data['salario'], $data['fecha_ingreso']]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE empleados SET nombre=?, apellido=?, cargo=?, salario=?, fecha_ingreso=? WHERE id_empleado=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['nombre'], $data['apellido'], $data['cargo'], $data['salario'], $data['fecha_ingreso'], $id]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM empleados WHERE id_empleado = ?");
        return $stmt->execute([$id]);
    }
}
?>