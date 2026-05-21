<?php
class ProductoController {
    private $model;
    private $categoriaModel;
    
    public function __construct() {
        global $pdo;
        $this->model = new Producto($pdo);
        $this->categoriaModel = new Categoria($pdo);
    }
    
    public function index() {
        $productos = $this->model->getAll();
        include 'views/layouts/header.php';
        include 'views/productos/index.php';
        include 'views/layouts/footer.php';
    }
    
    public function create() {
        $categorias = $this->categoriaModel->getAll();
        include 'views/layouts/header.php';
        include 'views/productos/create.php';
        include 'views/layouts/footer.php';
    }
    
    public function store() {
        $data = [
            'nombre' => $_POST['nombre'],
            'precio' => $_POST['precio'],
            'stock' => $_POST['stock'],
            'id_categoria' => $_POST['id_categoria']
        ];
        $this->model->create($data);
        header('Location: index.php?action=productos&mensaje=Producto creado');
    }
    
    public function edit($id) {
        $producto = $this->model->getById($id);
        $categorias = $this->categoriaModel->getAll();
        include 'views/layouts/header.php';
        include 'views/productos/edit.php';
        include 'views/layouts/footer.php';
    }
    
    public function update($id) {
        $data = [
            'nombre' => $_POST['nombre'],
            'precio' => $_POST['precio'],
            'stock' => $_POST['stock'],
            'id_categoria' => $_POST['id_categoria']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?action=productos&mensaje=Producto actualizado');
    }
    
    public function delete($id) {
        $this->model->delete($id);
        header('Location: index.php?action=productos&mensaje=Producto eliminado');
    }
}
?>