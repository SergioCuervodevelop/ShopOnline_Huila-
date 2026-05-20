<?php

require_once 'models/Producto.php';
require_once 'models/Categoria.php';

class ProductoController {
    private $productoModel;
    private $categoriaModel;
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
        $this->productoModel = new Producto($pdo);
        $this->categoriaModel = new Categoria($pdo);
    }
    
    // Listar productos
    public function index() {
        $productos = $this->productoModel->getAll();
        require_once 'views/layouts/header.php';
        require_once 'views/productos/index.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Mostrar formulario de creación
    public function create() {
        $categorias = $this->categoriaModel->getAll();
        require_once 'views/layouts/header.php';
        require_once 'views/productos/create.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Guardar producto
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'precio' => $_POST['precio'],
                'stock' => $_POST['stock'],
                'id_categoria' => $_POST['id_categoria']
            ];
            
            if ($this->productoModel->create($data)) {
                header('Location: index.php?action=productos&mensaje=Producto creado correctamente');
            } else {
                header('Location: index.php?action=producto_crear&error=Error al crear producto');
            }
        }
    }
    
    // Mostrar formulario de edición
    public function edit($id) {
        $producto = $this->productoModel->getById($id);
        $categorias = $this->categoriaModel->getAll();
        
        if (!$producto) {
            header('Location: index.php?action=productos&error=Producto no encontrado');
            return;
        }
        
        require_once 'views/layouts/header.php';
        require_once 'views/productos/edit.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Actualizar producto
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'precio' => $_POST['precio'],
                'stock' => $_POST['stock'],
                'id_categoria' => $_POST['id_categoria']
            ];
            
            if ($this->productoModel->update($id, $data)) {
                header('Location: index.php?action=productos&mensaje=Producto actualizado correctamente');
            } else {
                header('Location: index.php?action=producto_editar&id=' . $id . '&error=Error al actualizar');
            }
        }
    }
    
    // Eliminar producto
    public function delete($id) {
        if ($this->productoModel->delete($id)) {
            header('Location: index.php?action=productos&mensaje=Producto eliminado correctamente');
        } else {
            header('Location: index.php?action=productos&error=No se pudo eliminar el producto. Puede que tenga pedidos asociados.');
        }
    }
}
?>