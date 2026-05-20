<?php

require_once 'models/Empleado.php';

class EmpleadoController {
    private $empleadoModel;
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
        $this->empleadoModel = new Empleado($pdo);
    }
    
    // Listar empleados
    public function index() {
        $empleados = $this->empleadoModel->getAll();
        require_once 'views/layouts/header.php';
        require_once 'views/empleados/index.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Mostrar formulario de creación
    public function create() {
        require_once 'views/layouts/header.php';
        require_once 'views/empleados/create.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Guardar empleado
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'cargo' => $_POST['cargo'],
                'salario' => $_POST['salario'],
                'fecha_ingreso' => $_POST['fecha_ingreso']
            ];
            
            if ($this->empleadoModel->create($data)) {
                header('Location: index.php?action=empleados&mensaje=Empleado creado correctamente');
            } else {
                header('Location: index.php?action=empleado_crear&error=Error al crear empleado');
            }
        }
    }
    
    // Mostrar formulario de edición
    public function edit($id) {
        $empleado = $this->empleadoModel->getById($id);
        if (!$empleado) {
            header('Location: index.php?action=empleados&error=Empleado no encontrado');
            return;
        }
        require_once 'views/layouts/header.php';
        require_once 'views/empleados/edit.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Actualizar empleado
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'cargo' => $_POST['cargo'],
                'salario' => $_POST['salario'],
                'fecha_ingreso' => $_POST['fecha_ingreso']
            ];
            
            if ($this->empleadoModel->update($id, $data)) {
                header('Location: index.php?action=empleados&mensaje=Empleado actualizado correctamente');
            } else {
                header('Location: index.php?action=empleado_editar&id=' . $id . '&error=Error al actualizar');
            }
        }
    }
    
    // Eliminar empleado
    public function delete($id) {
        if ($this->empleadoModel->delete($id)) {
            header('Location: index.php?action=empleados&mensaje=Empleado eliminado correctamente');
        } else {
            header('Location: index.php?action=empleados&error=No se pudo eliminar el empleado');
        }
    }
}
?>