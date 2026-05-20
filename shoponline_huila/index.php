<?php

session_start();
require_once 'config/database.php';

// Autocarga simple de controladores y modelos
spl_autoload_register(function ($class) {
    $paths = ['models/', 'controllers/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Obtener la acción solicitada
$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

// Variable global para la conexión PDO
global $pdo;

// Enrutamiento 
if ($action == 'clientes') {
    $controller = new ClienteController();
    $controller->index();
} 
elseif ($action == 'cliente_crear') {
    $controller = new ClienteController();
    $controller->create();
} 
elseif ($action == 'cliente_guardar') {
    $controller = new ClienteController();
    $controller->store();
} 
elseif ($action == 'cliente_editar') {
    $controller = new ClienteController();
    $controller->edit($id);
} 
elseif ($action == 'cliente_actualizar') {
    $controller = new ClienteController();
    $controller->update($id);
} 
elseif ($action == 'cliente_eliminar') {
    $controller = new ClienteController();
    $controller->delete($id);
} 
elseif ($action == 'cliente_ver') {
    $controller = new ClienteController();
    $controller->show($id);
}
// ========== PRODUCTOS ==========
elseif ($action == 'productos') {
    $controller = new ProductoController();
    $controller->index();
} 
elseif ($action == 'producto_crear') {
    $controller = new ProductoController();
    $controller->create();
} 
elseif ($action == 'producto_guardar') {
    $controller = new ProductoController();
    $controller->store();
} 
elseif ($action == 'producto_editar') {
    $controller = new ProductoController();
    $controller->edit($id);
} 
elseif ($action == 'producto_actualizar') {
    $controller = new ProductoController();
    $controller->update($id);
} 
elseif ($action == 'producto_eliminar') {
    $controller = new ProductoController();
    $controller->delete($id);
}
// ========== EMPLEADOS ==========
elseif ($action == 'empleados') {
    $controller = new EmpleadoController();
    $controller->index();
} 
elseif ($action == 'empleado_crear') {
    $controller = new EmpleadoController();
    $controller->create();
} 
elseif ($action == 'empleado_guardar') {
    $controller = new EmpleadoController();
    $controller->store();
} 
elseif ($action == 'empleado_editar') {
    $controller = new EmpleadoController();
    $controller->edit($id);
} 
elseif ($action == 'empleado_actualizar') {
    $controller = new EmpleadoController();
    $controller->update($id);
} 
elseif ($action == 'empleado_eliminar') {
    $controller = new EmpleadoController();
    $controller->delete($id);
}
// ========== PEDIDOS ==========
elseif ($action == 'pedidos') {
    $controller = new PedidoController();
    $controller->index();
} 
elseif ($action == 'pedido_crear') {
    $controller = new PedidoController();
    $controller->create();
} 
elseif ($action == 'pedido_guardar') {
    $controller = new PedidoController();
    $controller->store();
} 
elseif ($action == 'pedido_ver') {
    $controller = new PedidoController();
    $controller->show($id);
}
// ========== CONSULTAS ==========
elseif ($action == 'consultas_pedidos_clientes') {
    $controller = new ConsultaController();
    $controller->pedidosConClientes();
} 
elseif ($action == 'consultas_productos_vendidos') {
    $controller = new ConsultaController();
    $controller->productosVendidos();
} 
elseif ($action == 'consultas_pedidos_por_cliente') {
    $controller = new ConsultaController();
    $controller->pedidosPorCliente();
} 
elseif ($action == 'consultas_detalle_pedido') {
    $controller = new ConsultaController();
    $controller->detallePedido();
} 
elseif ($action == 'consultas_pedidos_por_fecha') {
    $controller = new ConsultaController();
    $controller->pedidosPorFecha();
} 
elseif ($action == 'consultas_recaudado_producto') {
    $controller = new ConsultaController();
    $controller->recaudadoPorProducto();
} 
elseif ($action == 'consultas_empleados_por_pedido') {
    $controller = new ConsultaController();
    $controller->empleadosPorPedido();
}
// ========== PÁGINA DE INICIO ==========
else {
    require_once 'views/layouts/header.php';
    
    // Obtener estadísticas
    $totalClientes = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
    $totalProductos = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
    $totalPedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
    $totalEmpleados = $pdo->query("SELECT COUNT(*) FROM empleados")->fetchColumn();
    ?>
    
    <div class="fade-in">
        <!-- Header simple sin el texto que pediste quitar -->
        <div class="card-temu mb-4">
            <div class="card-header-temu" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: white; border: none;">
                <h4 class="mb-0" style="font-weight: 600;">
                    <i class="fas fa-store me-2"></i> ShopOnline Huila
                </h4>
                <p class="mb-0 mt-1" style="font-size: 0.85rem; opacity: 0.9;">Tu tienda online de confianza</p>
            </div>
        </div>
        
        <!-- Tarjetas de estadísticas -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number"><?php echo $totalClientes; ?></div>
                    <div class="stat-label">Clientes Registrados</div>
                    <a href="index.php?action=clientes" class="btn-temu-outline mt-3" style="font-size: 0.7rem;">Ver todos</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-box"></i></div>
                    <div class="stat-number"><?php echo $totalProductos; ?></div>
                    <div class="stat-label">Productos Activos</div>
                    <a href="index.php?action=productos" class="btn-temu-outline mt-3" style="font-size: 0.7rem;">Ver todos</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                    <div class="stat-number"><?php echo $totalPedidos; ?></div>
                    <div class="stat-label">Pedidos Realizados</div>
                    <a href="index.php?action=pedidos" class="btn-temu-outline mt-3" style="font-size: 0.7rem;">Ver todos</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
                    <div class="stat-number"><?php echo $totalEmpleados; ?></div>
                    <div class="stat-label">Empleados</div>
                    <a href="index.php?action=empleados" class="btn-temu-outline mt-3" style="font-size: 0.7rem;">Ver todos</a>
                </div>
            </div>
        </div>
        
        
<div class="card-naranja">
    <div class="card-header-naranja">
        <i class="fas fa-chart-line"></i> Panel de Control
    </div>
    <div class="p-4 text-center">
        <i class="fas fa-chart-pie" style="font-size: 3rem; color: #f97316; margin-bottom: 16px;"></i>
        <h5>Bienvenido al Panel de Control</h5>
        <p class="text-muted">Utilice el menú lateral para acceder a las diferentes secciones</p>
    </div>
</div>
    </div>
    
    <?php
    require_once 'views/layouts/footer.php';
}
?>