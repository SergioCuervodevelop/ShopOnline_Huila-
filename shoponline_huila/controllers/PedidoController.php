<?php

require_once 'models/Pedido.php';
require_once 'models/DetallePedido.php';
require_once 'models/Pago.php';
require_once 'models/Envio.php';
require_once 'models/Producto.php';
require_once 'models/Cliente.php';
require_once 'models/Empleado.php';

class PedidoController {
    private $pdo;
    private $pedidoModel;
    private $detalleModel;
    private $pagoModel;
    private $envioModel;
    private $productoModel;
    private $clienteModel;
    private $empleadoModel;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
        $this->pedidoModel = new Pedido($pdo);
        $this->detalleModel = new DetallePedido($pdo);
        $this->pagoModel = new Pago($pdo);
        $this->envioModel = new Envio($pdo);
        $this->productoModel = new Producto($pdo);
        $this->clienteModel = new Cliente($pdo);
        $this->empleadoModel = new Empleado($pdo);
    }
    
    // Listar todos los pedidos
    public function index() {
        $pedidos = $this->pedidoModel->getAllWithClientes();
        require_once 'views/layouts/header.php';
        require_once 'views/pedidos/index.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Mostrar formulario para crear nuevo pedido
    public function create() {
        $clientes = $this->clienteModel->getAll();
        $productos = $this->productoModel->getAll();
        $empleados = $this->empleadoModel->getAll();
        require_once 'views/layouts/header.php';
        require_once 'views/pedidos/create.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Guardar el pedido completo (incluye productos, pago y envío)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir datos del formulario
            $id_cliente = $_POST['id_cliente'];
            $direccion_envio = $_POST['direccion_envio'];
            $id_empleado = $_POST['id_empleado'];
            $metodo_pago = $_POST['metodo_pago'];
            $productos = $_POST['productos']; // Array con id_producto y cantidad
            
            // Validar que haya al menos un producto
            if (empty($productos)) {
                header('Location: index.php?action=pedido_crear&error=Debe agregar al menos un producto');
                return;
            }
            
            // Calcular el total del pedido
            $total = 0;
            $detalles = [];
            
            foreach ($productos as $item) {
                $prod = $this->productoModel->getById($item['id_producto']);
                if (!$prod) {
                    continue;
                }
                $subtotal = $prod['precio'] * $item['cantidad'];
                $total += $subtotal;
                $detalles[] = [
                    'id_producto' => $item['id_producto'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $prod['precio'],
                    'subtotal' => $subtotal
                ];
            }
            
            // 1. Crear el pedido
            $pedido_id = $this->pedidoModel->create($id_cliente, $total);
            
            // 2. Guardar los detalles del pedido y actualizar stock
            foreach ($detalles as $det) {
                $this->detalleModel->create(
                    $pedido_id,
                    $det['id_producto'],
                    $det['cantidad'],
                    $det['precio_unitario'],
                    $det['subtotal']
                );
                // Actualizar stock del producto
                $this->productoModel->updateStock($det['id_producto'], $det['cantidad']);
            }
            
            // 3. Registrar el pago
            $this->pagoModel->create($pedido_id, $metodo_pago, $total);
            
            // 4. Registrar el envío
            $this->envioModel->create($pedido_id, $id_empleado, $direccion_envio);
            
            // Redirigir a la lista de pedidos con mensaje de éxito
            header('Location: index.php?action=pedidos&mensaje=Pedido #' . $pedido_id . ' creado correctamente');
        }
    }
    
    // Ver detalles de un pedido específico
    public function show($id) {
        $pedido = $this->pedidoModel->getByIdWithDetails($id);
        $pago = $this->pagoModel->getByPedido($id);
        $envio = $this->envioModel->getByPedido($id);
        
        if (!$pedido) {
            header('Location: index.php?action=pedidos&error=Pedido no encontrado');
            return;
        }
        
        require_once 'views/layouts/header.php';
        require_once 'views/pedidos/show.php';
        require_once 'views/layouts/footer.php';
    }
}
?>