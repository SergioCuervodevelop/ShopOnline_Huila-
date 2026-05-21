<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ShopOnline Huila</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { background: #f5f5f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #1a1a2e;
            color: white;
            overflow-y: auto;
            z-index: 1000;
        }
        
        /* Contenido */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }
        
        /* Logo */
        .sidebar-logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        
        .sidebar-logo i { color: #f97316; }
        .sidebar-logo h4 { margin: 10px 0 5px; }
        .sidebar-logo small { opacity: 0.7; }
        
        /* Navegación */
        .nav-item {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .nav-item:hover {
            background: rgba(249,115,22,0.2);
            color: #f97316;
            padding-left: 25px;
        }
        
        .nav-item.active {
            background: rgba(249,115,22,0.3);
            color: #f97316;
            border-left: 3px solid #f97316;
        }
        
        .nav-sub { padding-left: 40px; font-size: 14px; }
        .nav-title { padding: 15px 20px 5px; font-size: 11px; text-transform: uppercase; color: #888; letter-spacing: 1px; }
        .nav-divider { margin: 10px 20px; border-color: rgba(255,255,255,0.1); }
        
        /* Tarjetas */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .stat-card:hover { transform: translateY(-5px); }
        
        /* Botón naranja */
        .btn-naranja {
            background: #f97316;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-naranja:hover {
            background: #ea580c;
            color: white;
            transform: scale(1.02);
        }
        
        /* Tarjetas naranja */
        .card-naranja {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .card-header-naranja {
            padding: 15px 20px;
            font-weight: bold;
            border-bottom: 1px solid #eee;
        }
        
        /* Tablas */
        .table-naranja {
            width: 100%;
            background: white;
        }
        
        .table-naranja th {
            background: #f8f9fa;
            padding: 12px;
            font-weight: 600;
        }
        
        .table-naranja td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
        
        .table-naranja tr:hover { background: #fff7ed; }
        
        /* Badges */
        .badge-naranja-success {
            background: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .badge-naranja-warning {
            background: #f97316;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        /* Animación */
        .fade-in { animation: fadeIn 0.4s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { width: 70px; }
            .sidebar .nav-item span, .sidebar .nav-title, .sidebar-logo h4, .sidebar-logo small { display: none; }
            .main-content { margin-left: 70px; }
            .nav-sub { padding-left: 20px; }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #1a1a2e; }
        ::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <i class="fas fa-store fa-2x"></i>
        <h4>ShopOnline</h4>
        <small>Huila</small>
    </div>
    
    <div class="nav-title">PRINCIPAL</div>
    <a href="index.php" class="nav-item <?= (!isset($_GET['action']) || $_GET['action'] == 'home') ? 'active' : '' ?>">
        <i class="fas fa-tachometer-alt"></i> <span>Inicio</span>
    </a>
    
    <hr class="nav-divider">
    <div class="nav-title">ADMINISTRAR</div>
    
    <a href="index.php?action=clientes" class="nav-item <?= ($_GET['action'] ?? '') == 'clientes' ? 'active' : '' ?>">
        <i class="fas fa-users"></i> <span>Clientes</span>
    </a>
    <a href="index.php?action=cliente_crear" class="nav-item nav-sub">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Cliente</span>
    </a>
    
    <a href="index.php?action=productos" class="nav-item <?= ($_GET['action'] ?? '') == 'productos' ? 'active' : '' ?>">
        <i class="fas fa-box"></i> <span>Productos</span>
    </a>
    <a href="index.php?action=producto_crear" class="nav-item nav-sub">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Producto</span>
    </a>
    
    <a href="index.php?action=empleados" class="nav-item <?= ($_GET['action'] ?? '') == 'empleados' ? 'active' : '' ?>">
        <i class="fas fa-user-tie"></i> <span>Empleados</span>
    </a>
    <a href="index.php?action=empleado_crear" class="nav-item nav-sub">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Empleado</span>
    </a>
    
    <a href="index.php?action=pedidos" class="nav-item <?= ($_GET['action'] ?? '') == 'pedidos' ? 'active' : '' ?>">
        <i class="fas fa-shopping-cart"></i> <span>Pedidos</span>
    </a>
    <a href="index.php?action=pedido_crear" class="nav-item nav-sub">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Pedido</span>
    </a>
    
    <hr class="nav-divider">
    <div class="nav-title">REPORTES</div>
    
    <a href="index.php?action=consultas_pedidos_clientes" class="nav-item">
        <i class="fas fa-receipt"></i> <span>Pedidos x Cliente</span>
    </a>
    <a href="index.php?action=consultas_productos_vendidos" class="nav-item">
        <i class="fas fa-chart-line"></i> <span>Productos Vendidos</span>
    </a>
    <a href="index.php?action=consultas_pedidos_por_cliente" class="nav-item">
        <i class="fas fa-user"></i> <span>Pedidos por Cliente</span>
    </a>
    <a href="index.php?action=consultas_detalle_pedido" class="nav-item">
        <i class="fas fa-info-circle"></i> <span>Detalle Pedido</span>
    </a>
    <a href="index.php?action=consultas_pedidos_por_fecha" class="nav-item">
        <i class="fas fa-calendar"></i> <span>Pedidos por Fecha</span>
    </a>
    <a href="index.php?action=consultas_recaudado_producto" class="nav-item">
        <i class="fas fa-dollar-sign"></i> <span>Recaudado x Producto</span>
    </a>
    <a href="index.php?action=consultas_empleados_por_pedido" class="nav-item">
        <i class="fas fa-truck"></i> <span>Empleados x Pedido</span>
    </a>
    
    <hr class="nav-divider">
    <div class="text-center py-3" style="font-size: 11px; color: #666;">
        <i class="far fa-clock"></i> <span id="reloj"></span>
    </div>
</div>

<div class="main-content">

<script>
function actualizarReloj() {
    var reloj = document.getElementById('reloj');
    if(reloj) {
        var ahora = new Date();
        reloj.textContent = ahora.toLocaleString('es-ES');
    }
}
setInterval(actualizarReloj, 1000);
actualizarReloj();
</script>

<?php if(isset($_GET['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #e6f7e6; border-left: 4px solid #28a745;">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_GET['mensaje']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: #fee2e2; border-left: 4px solid #dc2626;">
        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>