<?php
class ConsultaController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    // Consulta 1: Pedidos con clientes
    public function pedidosConClientes() {
        $sql = "SELECT p.id_pedido, p.fecha_pedido, p.total, p.estado, 
                       CONCAT(c.nombre, ' ', c.apellido) AS cliente_nombre
                FROM pedidos p 
                JOIN clientes c ON p.id_cliente = c.id_cliente
                ORDER BY p.fecha_pedido DESC";
        $stmt = $this->pdo->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/pedidos_con_clientes.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Consulta 2: Productos vendidos
    public function productosVendidos() {
        $sql = "SELECT p.id_producto, p.nombre, p.precio,
                       COALESCE(SUM(dp.cantidad), 0) AS total_vendido
                FROM productos p
                LEFT JOIN detalle_pedido dp ON p.id_producto = dp.id_producto
                GROUP BY p.id_producto
                ORDER BY total_vendido DESC";
        $stmt = $this->pdo->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/productos_vendidos.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Consulta 3: Pedidos por cliente
    public function pedidosPorCliente() {
        $id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : 0;
        
        // Obtener todos los clientes para el selector
        $stmtClientes = $this->pdo->query("SELECT id_cliente, nombre, apellido FROM clientes ORDER BY nombre");
        $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);
        
        $cliente_info = null;
        $pedidos = [];
        
        if ($id_cliente > 0) {
            $stmtCli = $this->pdo->prepare("SELECT id_cliente, nombre, apellido FROM clientes WHERE id_cliente = ?");
            $stmtCli->execute([$id_cliente]);
            $cliente_info = $stmtCli->fetch(PDO::FETCH_ASSOC);
            
            $sql = "SELECT id_pedido, fecha_pedido, total, estado 
                    FROM pedidos 
                    WHERE id_cliente = ?
                    ORDER BY fecha_pedido DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_cliente]);
            $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/pedidos_por_cliente.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Consulta 4: Detalle de pedido
    public function detallePedido() {
        $id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : 0;
        $pedido = null;
        $productos = [];
        
        if ($id_pedido > 0) {
            $sqlPedido = "SELECT p.*, CONCAT(c.nombre, ' ', c.apellido) AS cliente_nombre, c.correo, c.telefono
                         FROM pedidos p
                         JOIN clientes c ON p.id_cliente = c.id_cliente
                         WHERE p.id_pedido = ?";
            $stmt = $this->pdo->prepare($sqlPedido);
            $stmt->execute([$id_pedido]);
            $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $sqlProductos = "SELECT dp.*, pr.nombre, pr.precio
                            FROM detalle_pedido dp
                            JOIN productos pr ON dp.id_producto = pr.id_producto
                            WHERE dp.id_pedido = ?";
            $stmtProd = $this->pdo->prepare($sqlProductos);
            $stmtProd->execute([$id_pedido]);
            $productos = $stmtProd->fetchAll(PDO::FETCH_ASSOC);
        }
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/detalle_pedido.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Consulta 5: Pedidos por fecha
    public function pedidosPorFecha() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        
        $sql = "SELECT p.id_pedido, p.fecha_pedido, p.total, p.estado,
                       c.nombre, c.apellido,
                       pa.metodo_pago, pa.valor_pago, pa.fecha_pago
                FROM pedidos p
                JOIN clientes c ON p.id_cliente = c.id_cliente
                JOIN pagos pa ON p.id_pedido = pa.id_pedido
                WHERE DATE(p.fecha_pedido) = ?
                ORDER BY p.fecha_pedido DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$fecha]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/pedidos_por_fecha.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Consulta 6: Recaudado por producto
    public function recaudadoPorProducto() {
        $sql = "SELECT p.id_producto, p.nombre, p.precio,
                       COALESCE(SUM(dp.cantidad), 0) AS total_vendido,
                       COALESCE(SUM(dp.subtotal), 0) AS total_recaudado
                FROM productos p
                LEFT JOIN detalle_pedido dp ON p.id_producto = dp.id_producto
                GROUP BY p.id_producto
                ORDER BY total_recaudado DESC";
        $stmt = $this->pdo->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/recaudado_por_producto.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Consulta 7: Empleados que despacharon un pedido
    public function empleadosPorPedido() {
        $id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : 0;
        $empleados = [];
        $pedido_info = null;
        $pedidosRecientes = [];
        
        if ($id_pedido > 0) {
            // Obtener información del pedido
            $stmtPedido = $this->pdo->prepare("SELECT id_pedido, total, estado FROM pedidos WHERE id_pedido = ?");
            $stmtPedido->execute([$id_pedido]);
            $pedido_info = $stmtPedido->fetch(PDO::FETCH_ASSOC);
            
            // Obtener empleados que despacharon este pedido
            $sql = "SELECT e.id_empleado, e.nombre, e.apellido, e.cargo, e.salario,
                           env.fecha_envio, env.estado_envio, env.direccion_envio
                    FROM envios env
                    JOIN empleados e ON env.id_empleado = e.id_empleado
                    WHERE env.id_pedido = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_pedido]);
            $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Obtener pedidos recientes para el selector rápido
        $stmtRecientes = $this->pdo->query("SELECT id_pedido, fecha_pedido, total FROM pedidos ORDER BY id_pedido DESC LIMIT 5");
        $pedidosRecientes = $stmtRecientes->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/layouts/header.php';
        require_once 'views/consultas/empleados_por_pedido.php';
        require_once 'views/layouts/footer.php';
    }
}
?>