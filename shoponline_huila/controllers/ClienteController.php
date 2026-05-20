<?php

require_once 'models/Cliente.php';

class ClienteController {
    private $clienteModel;
    private $pdo;
    
    public function __construct() {
        global $pdo;  // Usar la conexión creada en database.php
        $this->pdo = $pdo;
        $this->clienteModel = new Cliente($pdo);
    }
    
    // Mostrar listado de clientes
    public function index() {
        $clientes = $this->clienteModel->getAll();
        require_once 'views/layouts/header.php';
        require_once 'views/clientes/index.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Mostrar formulario para crear cliente
    public function create() {
        require_once 'views/layouts/header.php';
        require_once 'views/clientes/create.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Guardar nuevo cliente en la base de datos
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion']
            ];
            
            if ($this->clienteModel->create($data)) {
                header('Location: index.php?action=clientes&mensaje=Cliente creado correctamente');
            } else {
                header('Location: index.php?action=cliente_crear&error=Error al crear cliente');
            }
        }
    }
    
    // Mostrar formulario para editar cliente
    public function edit($id) {
        $cliente = $this->clienteModel->getById($id);
        if (!$cliente) {
            header('Location: index.php?action=clientes&error=Cliente no encontrado');
            return;
        }
        require_once 'views/layouts/header.php';
        require_once 'views/clientes/edit.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Actualizar cliente en la base de datos
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion']
            ];
            
            if ($this->clienteModel->update($id, $data)) {
                header('Location: index.php?action=clientes&mensaje=Cliente actualizado correctamente');
            } else {
                header('Location: index.php?action=cliente_editar&id=' . $id . '&error=Error al actualizar');
            }
        }
    }
    
    // Eliminar cliente
    public function delete($id) {
        if ($this->clienteModel->delete($id)) {
            header('Location: index.php?action=clientes&mensaje=Cliente eliminado correctamente');
        } else {
            header('Location: index.php?action=clientes&error=No se pudo eliminar el cliente');
        }
    }
    
    // Ver detalles de un cliente
    public function show($id) {
        $cliente = $this->clienteModel->getById($id);
        if (!$cliente) {
            header('Location: index.php?action=clientes&error=Cliente no encontrado');
            return;
        }
        require_once 'views/layouts/header.php';
        require_once 'views/clientes/show.php';
        require_once 'views/layouts/footer.php';
    }
}
?>