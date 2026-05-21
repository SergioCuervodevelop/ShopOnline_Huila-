<?php
class ConsultaController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function pedidosConClientes() {
        $stmt = $this->pdo->query("SELECT p.id_pedido, p.fecha_pedido, p.total, p.estado, CONCAT(c.nombre, ' ', c.apellido) AS cliente FROM pedidos p JOIN clientes c ON p.id_cliente = c.id_cliente ORDER BY p.fecha_pedido DESC");
        $resultados = $stmt->fetchAll();
        include 'views/layouts/header.php';
        include 'views/consultas/pedidos_con_clientes.php';
        include 'views/layouts/footer.php';
    }
    
    public function productosVendidos() {
        $stmt = $this->pdo->query("SELECT p.id_producto, p.nombre, p.precio, COALESCE(SUM(dp.cantidad), 0) AS vendidos FROM productos p LEFT JOIN detalle_pedido dp ON p.id_producto = dp.id_producto GROUP BY p.id_producto ORDER BY vendidos DESC");
        $resultados = $stmt->fetchAll();
        include 'views/layouts/header.php';
        include 'views/consultas/productos_vendidos.php';
        include 'views/layouts/footer.php';
    }
    
    public function pedidosPorCliente() {
        $id_cliente = $_GET['id_cliente'] ?? 0;
        $clientes = $this->pdo->query("SELECT * FROM clientes")->fetchAll();
        $cliente_info = null;
        $pedidos = [];
        
        if($id_cliente > 0) {
            $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
            $stmt->execute([$id_cliente]);
            $cliente_info = $stmt->fetch();
            
            $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE id_cliente = ? ORDER BY fecha_pedido DESC");
            $stmt->execute([$id_cliente]);
            $pedidos = $stmt->fetchAll();
        }
        
        include 'views/layouts/header.php';
        include 'views/consultas/pedidos_por_cliente.php';
        include 'views/layouts/footer.php';
    }
    
    public function detallePedido() {
        $id_pedido = $_GET['id_pedido'] ?? 0;
        $pedido = null;
        $productos = [];
        
        if($id_pedido > 0) {
            $stmt = $this->pdo->prepare("SELECT p.*, CONCAT(c.nombre, ' ', c.apellido) AS cliente, e.direccion_envio FROM pedidos p JOIN clientes c ON p.id_cliente = c.id_cliente LEFT JOIN envios e ON p.id_pedido = e.id_pedido WHERE p.id_pedido = ?");
            $stmt->execute([$id_pedido]);
            $pedido = $stmt->fetch();
            
            $stmt = $this->pdo->prepare("SELECT dp.*, pr.nombre FROM detalle_pedido dp JOIN productos pr ON dp.id_producto = pr.id_producto WHERE dp.id_pedido = ?");
            $stmt->execute([$id_pedido]);
            $productos = $stmt->fetchAll();
        }
        
        include 'views/layouts/header.php';
        include 'views/consultas/detalle_pedido.php';
        include 'views/layouts/footer.php';
    }
    
    public function pedidosPorFecha() {
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $stmt = $this->pdo->prepare("SELECT p.*, c.nombre, c.apellido, pa.metodo_pago, pa.valor_pago FROM pedidos p JOIN clientes c ON p.id_cliente = c.id_cliente JOIN pagos pa ON p.id_pedido = pa.id_pedido WHERE DATE(p.fecha_pedido) = ?");
        $stmt->execute([$fecha]);
        $resultados = $stmt->fetchAll();
        
        include 'views/layouts/header.php';
        include 'views/consultas/pedidos_por_fecha.php';
        include 'views/layouts/footer.php';
    }
    
    public function recaudadoPorProducto() {
        $stmt = $this->pdo->query("SELECT p.id_producto, p.nombre, p.precio, COALESCE(SUM(dp.cantidad), 0) AS vendidos, COALESCE(SUM(dp.subtotal), 0) AS recaudado FROM productos p LEFT JOIN detalle_pedido dp ON p.id_producto = dp.id_producto GROUP BY p.id_producto ORDER BY recaudado DESC");
        $resultados = $stmt->fetchAll();
        
        include 'views/layouts/header.php';
        include 'views/consultas/recaudado_por_producto.php';
        include 'views/layouts/footer.php';
    }
    
    public function empleadosPorPedido() {
        $id_pedido = $_GET['id_pedido'] ?? 0;
        $empleados = [];
        $pedido_info = null;
        
        if($id_pedido > 0) {
            $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE id_pedido = ?");
            $stmt->execute([$id_pedido]);
            $pedido_info = $stmt->fetch();
            
            $stmt = $this->pdo->prepare("SELECT e.*, env.fecha_envio, env.estado_envio, env.direccion_envio FROM envios env JOIN empleados e ON env.id_empleado = e.id_empleado WHERE env.id_pedido = ?");
            $stmt->execute([$id_pedido]);
            $empleados = $stmt->fetchAll();
        }
        
        $recientes = $this->pdo->query("SELECT id_pedido, fecha_pedido FROM pedidos ORDER BY id_pedido DESC LIMIT 5")->fetchAll();
        
        include 'views/layouts/header.php';
        include 'views/consultas/empleados_por_pedido.php';
        include 'views/layouts/footer.php';
    }
}
?>