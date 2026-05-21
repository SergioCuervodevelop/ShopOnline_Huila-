<?php
class ClienteController {
    private $model;
    
    public function __construct() {
        global $pdo;
        $this->model = new Cliente($pdo);
    }
    
    public function index() {
        $clientes = $this->model->getAll();
        include 'views/layouts/header.php';
        include 'views/clientes/index.php';
        include 'views/layouts/footer.php';
    }
    
    public function create() {
        include 'views/layouts/header.php';
        include 'views/clientes/create.php';
        include 'views/layouts/footer.php';
    }
    
    public function store() {
        $data = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'correo' => $_POST['correo'],
            'telefono' => $_POST['telefono'],
            'direccion' => $_POST['direccion']
        ];
        if($this->model->create($data)) {
            header('Location: index.php?action=clientes&mensaje=Cliente creado');
        } else {
            header('Location: index.php?action=cliente_crear&error=Error');
        }
    }
    
    public function edit($id) {
        $cliente = $this->model->getById($id);
        include 'views/layouts/header.php';
        include 'views/clientes/edit.php';
        include 'views/layouts/footer.php';
    }
    
    public function update($id) {
        $data = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'correo' => $_POST['correo'],
            'telefono' => $_POST['telefono'],
            'direccion' => $_POST['direccion']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?action=clientes&mensaje=Cliente actualizado');
    }
    
    public function delete($id) {
        $this->model->delete($id);
        header('Location: index.php?action=clientes&mensaje=Cliente eliminado');
    }
}
?>