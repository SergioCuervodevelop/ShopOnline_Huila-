<?php
class EmpleadoController {
    private $model;
    
    public function __construct() {
        global $pdo;
        $this->model = new Empleado($pdo);
    }
    
    public function index() {
        $empleados = $this->model->getAll();
        include 'views/layouts/header.php';
        include 'views/empleados/index.php';
        include 'views/layouts/footer.php';
    }
    
    public function create() {
        include 'views/layouts/header.php';
        include 'views/empleados/create.php';
        include 'views/layouts/footer.php';
    }
    
    public function store() {
        $data = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'cargo' => $_POST['cargo'],
            'salario' => $_POST['salario'],
            'fecha_ingreso' => $_POST['fecha_ingreso']
        ];
        $this->model->create($data);
        header('Location: index.php?action=empleados&mensaje=Empleado creado');
    }
    
    public function edit($id) {
        $empleado = $this->model->getById($id);
        include 'views/layouts/header.php';
        include 'views/empleados/edit.php';
        include 'views/layouts/footer.php';
    }
    
    public function update($id) {
        $data = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'cargo' => $_POST['cargo'],
            'salario' => $_POST['salario'],
            'fecha_ingreso' => $_POST['fecha_ingreso']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?action=empleados&mensaje=Empleado actualizado');
    }
    
    public function delete($id) {
        $this->model->delete($id);
        header('Location: index.php?action=empleados&mensaje=Empleado eliminado');
    }
}
?>