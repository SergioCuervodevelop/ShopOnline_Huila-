<?php
session_start();
require_once 'config/database.php';

spl_autoload_register(function($class) {
    if(file_exists("models/$class.php")) require_once "models/$class.php";
    if(file_exists("controllers/$class.php")) require_once "controllers/$class.php";
});

$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;
$isAjax = isset($_GET['ajax']);

if($action == 'clientes') { $ctrl = new ClienteController(); $ctrl->index(); }
elseif($action == 'cliente_crear') { $ctrl = new ClienteController(); $ctrl->create(); }
elseif($action == 'cliente_guardar') { $ctrl = new ClienteController(); $ctrl->store(); }
elseif($action == 'cliente_editar') { $ctrl = new ClienteController(); $ctrl->edit($id); }
elseif($action == 'cliente_actualizar') { $ctrl = new ClienteController(); $ctrl->update($id); }
elseif($action == 'cliente_eliminar') { $ctrl = new ClienteController(); $ctrl->delete($id); }
elseif($action == 'productos') { $ctrl = new ProductoController(); $ctrl->index(); }
elseif($action == 'producto_crear') { $ctrl = new ProductoController(); $ctrl->create(); }
elseif($action == 'producto_guardar') { $ctrl = new ProductoController(); $ctrl->store(); }
elseif($action == 'producto_editar') { $ctrl = new ProductoController(); $ctrl->edit($id); }
elseif($action == 'producto_actualizar') { $ctrl = new ProductoController(); $ctrl->update($id); }
elseif($action == 'producto_eliminar') { $ctrl = new ProductoController(); $ctrl->delete($id); }
elseif($action == 'empleados') { $ctrl = new EmpleadoController(); $ctrl->index(); }
elseif($action == 'empleado_crear') { $ctrl = new EmpleadoController(); $ctrl->create(); }
elseif($action == 'empleado_guardar') { $ctrl = new EmpleadoController(); $ctrl->store(); }
elseif($action == 'empleado_editar') { $ctrl = new EmpleadoController(); $ctrl->edit($id); }
elseif($action == 'empleado_actualizar') { $ctrl = new EmpleadoController(); $ctrl->update($id); }
elseif($action == 'empleado_eliminar') { $ctrl = new EmpleadoController(); $ctrl->delete($id); }
elseif($action == 'pedidos') { $ctrl = new PedidoController(); $ctrl->index(); }
elseif($action == 'pedido_crear') { $ctrl = new PedidoController(); $ctrl->create(); }
elseif($action == 'pedido_guardar') { $ctrl = new PedidoController(); $ctrl->store(); }
elseif($action == 'pedido_ver') { $ctrl = new PedidoController(); $ctrl->show($id); }
elseif($action == 'consultas_pedidos_clientes') { $ctrl = new ConsultaController(); $ctrl->pedidosConClientes(); }
elseif($action == 'consultas_productos_vendidos') { $ctrl = new ConsultaController(); $ctrl->productosVendidos(); }
elseif($action == 'consultas_pedidos_por_cliente') { $ctrl = new ConsultaController(); $ctrl->pedidosPorCliente(); }
elseif($action == 'consultas_detalle_pedido') { $ctrl = new ConsultaController(); $ctrl->detallePedido(); }
elseif($action == 'consultas_pedidos_por_fecha') { $ctrl = new ConsultaController(); $ctrl->pedidosPorFecha(); }
elseif($action == 'consultas_recaudado_producto') { $ctrl = new ConsultaController(); $ctrl->recaudadoPorProducto(); }
elseif($action == 'consultas_empleados_por_pedido') { $ctrl = new ConsultaController(); $ctrl->empleadosPorPedido(); }
else {
    // DASHBOARD DE INICIO
    include 'views/layouts/header.php';
    
    // Contar registros
    $totalClientes = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
    $totalProductos = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
    $totalPedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
    $totalEmpleados = $pdo->query("SELECT COUNT(*) FROM empleados")->fetchColumn();
    ?>
    
    <div class="fade-in">
        <!-- Banner de bienvenida -->
        <div class="card-naranja mb-4">
            <div style="background: linear-gradient(135deg, #f97316, #ea580c); color: white; padding: 30px; border-radius: 12px;">
                <h2><i class="fas fa-store"></i> ShopOnline Huila</h2>
                <p class="mb-0">Sistema de Gestión de Ventas en Línea</p>
            </div>
        </div>
        
        <!-- Tarjetas de estadísticas -->
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-top: 4px solid #f97316;">
                    <i class="fas fa-users" style="font-size: 40px; color: #f97316;"></i>
                    <h2 class="mt-2"><?= $totalClientes ?></h2>
                    <p class="text-muted">Clientes</p>
                    <a href="index.php?action=clientes" class="btn-naranja" style="padding: 5px 15px; font-size: 12px;">Ver todos</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-top: 4px solid #f97316;">
                    <i class="fas fa-box" style="font-size: 40px; color: #f97316;"></i>
                    <h2 class="mt-2"><?= $totalProductos ?></h2>
                    <p class="text-muted">Productos</p>
                    <a href="index.php?action=productos" class="btn-naranja" style="padding: 5px 15px; font-size: 12px;">Ver todos</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-top: 4px solid #f97316;">
                    <i class="fas fa-shopping-cart" style="font-size: 40px; color: #f97316;"></i>
                    <h2 class="mt-2"><?= $totalPedidos ?></h2>
                    <p class="text-muted">Pedidos</p>
                    <a href="index.php?action=pedidos" class="btn-naranja" style="padding: 5px 15px; font-size: 12px;">Ver todos</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-top: 4px solid #f97316;">
                    <i class="fas fa-user-tie" style="font-size: 40px; color: #f97316;"></i>
                    <h2 class="mt-2"><?= $totalEmpleados ?></h2>
                    <p class="text-muted">Empleados</p>
                    <a href="index.php?action=empleados" class="btn-naranja" style="padding: 5px 15px; font-size: 12px;">Ver todos</a>
                </div>
            </div>
        </div>
        
        <!-- Últimos pedidos -->
        <div class="card-naranja mt-3">
            <div class="card-header-naranja" style="background: #f97316; color: white;">
                <i class="fas fa-clock"></i> Últimos Pedidos
            </div>
            <div class="p-0">
                <table class="table-naranja" style="width: 100%;">
                    <thead style="background: #f8f9fa;">
                        <tr><th>ID</th><th>Fecha</th><th>Cliente</th><th>Total</th><th>Estado</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $ultimos = $pdo->query("SELECT p.*, c.nombre, c.apellido FROM pedidos p JOIN clientes c ON p.id_cliente = c.id_cliente ORDER BY p.id_pedido DESC LIMIT 5");
                        foreach($ultimos as $u):
                        ?>
                        <tr>
                            <td>#<?= $u['id_pedido'] ?></td>
                            <td><?= date('d/m/Y', strtotime($u['fecha_pedido'])) ?></td>
                            <td><?= $u['nombre'] . ' ' . $u['apellido'] ?></td>
                            <td>$<?= number_format($u['total'], 0, ',', '.') ?></td>
                            <td><span class="badge-naranja-warning"><?= $u['estado'] ?></span></td>
                            <td><a href="index.php?action=pedido_ver&id=<?= $u['id_pedido'] ?>" class="btn btn-sm btn-info">Ver</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php
    include 'views/layouts/footer.php';
}
?>