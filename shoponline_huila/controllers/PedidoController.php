<?php
class PedidoController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        $stmt = $this->pdo->query("SELECT p.*, c.nombre, c.apellido FROM pedidos p JOIN clientes c ON p.id_cliente = c.id_cliente ORDER BY p.id_pedido DESC");
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/layouts/header.php';
        include 'views/pedidos/index.php';
        include 'views/layouts/footer.php';
    }
    
    public function create() {
        $clientes = $this->pdo->query("SELECT * FROM clientes")->fetchAll();
        $productos = $this->pdo->query("SELECT * FROM productos")->fetchAll();
        $empleados = $this->pdo->query("SELECT * FROM empleados")->fetchAll();
        include 'views/layouts/header.php';
        include 'views/pedidos/create.php';
        include 'views/layouts/footer.php';
    }
    
    public function store() {
        $id_cliente = $_POST['id_cliente'];
        $direccion = $_POST['direccion_envio'];
        $id_empleado = $_POST['id_empleado'];
        $metodo_pago = $_POST['metodo_pago'];
        $productos = $_POST['productos'];
        
        $total = 0;
        $detalles = [];
        
        foreach($productos as $item) {
            $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id_producto = ?");
            $stmt->execute([$item['id_producto']]);
            $prod = $stmt->fetch();
            $subtotal = $prod['precio'] * $item['cantidad'];
            $total += $subtotal;
            $detalles[] = [
                'id_producto' => $item['id_producto'],
                'cantidad' => $item['cantidad'],
                'precio' => $prod['precio'],
                'subtotal' => $subtotal
            ];
        }
        
        $stmt = $this->pdo->prepare("INSERT INTO pedidos (id_cliente, total, estado) VALUES (?, ?, 'pagado')");
        $stmt->execute([$id_cliente, $total]);
        $pedido_id = $this->pdo->lastInsertId();
        
        foreach($detalles as $det) {
            $stmt = $this->pdo->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$pedido_id, $det['id_producto'], $det['cantidad'], $det['precio'], $det['subtotal']]);
            
            $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
            $stmt->execute([$det['cantidad'], $det['id_producto']]);
        }
        
        $stmt = $this->pdo->prepare("INSERT INTO pagos (id_pedido, metodo_pago, valor_pago) VALUES (?, ?, ?)");
        $stmt->execute([$pedido_id, $metodo_pago, $total]);
        
        $stmt = $this->pdo->prepare("INSERT INTO envios (id_pedido, id_empleado, direccion_envio) VALUES (?, ?, ?)");
        $stmt->execute([$pedido_id, $id_empleado, $direccion]);
        
        header('Location: index.php?action=pedidos&mensaje=Pedido creado');
    }
    
    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT p.*, c.nombre, c.apellido, c.correo, c.telefono FROM pedidos p JOIN clientes c ON p.id_cliente = c.id_cliente WHERE p.id_pedido = ?");
        $stmt->execute([$id]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $this->pdo->prepare("SELECT dp.*, pr.nombre FROM detalle_pedido dp JOIN productos pr ON dp.id_producto = pr.id_producto WHERE dp.id_pedido = ?");
        $stmt->execute([$id]);
        $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/layouts/header.php';
        include 'views/pedidos/show.php';
        include 'views/layouts/footer.php';
    }
}
?>