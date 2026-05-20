<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopOnline Huila - Sistema de Ventas</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f5f5f5;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* Sidebar fijo */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: white;
            color: #333;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 12px rgba(0,0,0,0.05);
            border-right: 1px solid #f0f0f0;
        }
        
        /* Contenido principal */
        .main-content {
            margin-left: 280px;
            padding: 24px 32px;
            min-height: 100vh;
        }
        
        /* Logo */
        .sidebar-logo {
            padding: 24px 20px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 16px;
        }
        
        .sidebar-logo i {
            font-size: 2rem;
            color: #f97316;
        }
        
        .sidebar-logo h3 {
            font-size: 1.4rem;
            margin: 12px 0 4px;
            font-weight: 700;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .sidebar-logo p {
            font-size: 0.7rem;
            color: #999;
            margin: 0;
        }
        
        /* Navegación */
        .nav-item {
            display: block;
            padding: 12px 24px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
            border-radius: 12px;
            margin: 4px 12px;
            cursor: pointer;
        }
        
        .nav-item:hover {
            background: #fff7ed;
            color: #f97316;
        }
        
        .nav-item.active {
            background: #fff7ed;
            color: #f97316;
            border-left: 3px solid #f97316;
        }
        
        .nav-item i {
            width: 28px;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        .nav-sub {
            padding-left: 52px;
            font-size: 13px;
            font-weight: 400;
            color: #718096;
        }
        
        .nav-divider {
            margin: 16px 20px;
            border-color: #f0f0f0;
        }
        
        .nav-title {
            padding: 12px 24px 8px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #a0aec0;
        }
        
        /* Tarjetas de estadísticas */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(249,115,22,0.1);
            border-color: #f97316;
        }
        
        .stat-icon {
            font-size: 2.2rem;
            margin-bottom: 12px;
            color: #f97316;
        }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a202c;
        }
        
        .stat-label {
            color: #718096;
            font-size: 0.8rem;
            margin-top: 6px;
        }
        
        /* Botón naranja */
        .btn-naranja {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        
        .btn-naranja:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            transform: scale(1.02);
            color: white;
        }
        
        /* Botón naranja outline */
        .btn-naranja-outline {
            background: transparent;
            border: 1.5px solid #f97316;
            padding: 8px 20px;
            border-radius: 40px;
            color: #f97316;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        
        .btn-naranja-outline:hover {
            background: #f97316;
            color: white;
        }
        
        /* Tarjeta naranja */
        .card-naranja {
            background: white;
            border-radius: 20px;
            border: 1px solid #f0f0f0;
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        
        .card-header-naranja {
            background: white;
            padding: 18px 24px;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
            font-size: 1rem;
            color: #1a202c;
        }
        
        .card-header-naranja i {
            color: #f97316;
            margin-right: 8px;
        }
        
        /* Tabla naranja */
        .table-naranja {
            width: 100%;
            background: white;
        }
        
        .table-naranja th {
            background: #fafafa;
            padding: 14px 16px;
            font-weight: 600;
            font-size: 0.8rem;
            color: #4a5568;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table-naranja td {
            padding: 12px 16px;
            border-bottom: 1px solid #f5f5f5;
            font-size: 0.85rem;
            color: #4a5568;
        }
        
        .table-naranja tr:hover {
            background: #fff7ed;
        }
        
        /* Badges */
        .badge-naranja-success {
            background: #e6f7e6;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .badge-naranja-warning {
            background: #fff3e0;
            color: #f97316;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .badge-naranja-danger {
            background: #fee2e2;
            color: #dc2626;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .badge-naranja-info {
            background: #e0f2fe;
            color: #0284c7;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        /* Formularios */
        .form-control-naranja {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 0.85rem;
            transition: all 0.2s;
            width: 100%;
        }
        
        .form-control-naranja:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249,115,22,0.1);
            outline: none;
        }
        
        /* Alertas */
        .alert-naranja-success {
            background: #e6f7e6;
            border: none;
            border-radius: 16px;
            color: #2e7d32;
            padding: 14px 20px;
        }
        
        .alert-naranja-danger {
            background: #fee2e2;
            border: none;
            border-radius: 16px;
            color: #dc2626;
            padding: 14px 20px;
        }
        
        /* Animación */
        .fade-in {
            animation: fadeIn 0.4s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f0f0f0;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #f97316;
            border-radius: 10px;
        }
        
        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }
        
        .sidebar {
            overflow-y: auto;
            scrollbar-width: thin;
        }
        
        .main-content {
            overflow-y: auto;
            height: 100vh;
            scroll-behavior: smooth;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar .nav-item span,
            .sidebar .nav-title,
            .sidebar-logo h3,
            .sidebar-logo p {
                display: none;
            }
            .main-content {
                margin-left: 70px;
                padding: 16px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <i class="fas fa-store"></i>
        <h3>ShopOnline</h3>
        <p>Huila</p>
    </div>
    
    <?php
    $current_action = isset($_GET['action']) ? $_GET['action'] : 'home';
    ?>
    
    <a href="index.php" class="nav-item scroll-preserve <?php echo ($current_action == 'home') ? 'active' : ''; ?>">
        <i class="fas fa-th-large"></i> <span>Inicio</span>
    </a>
    
    <hr class="nav-divider">
    
    <div class="nav-title">ADMINISTRAR</div>
    
    <a href="index.php?action=clientes" class="nav-item scroll-preserve <?php echo ($current_action == 'clientes') ? 'active' : ''; ?>">
        <i class="fas fa-users"></i> <span>Clientes</span>
    </a>
    <a href="index.php?action=cliente_crear" class="nav-item nav-sub scroll-preserve">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Cliente</span>
    </a>
    
    <a href="index.php?action=productos" class="nav-item scroll-preserve <?php echo ($current_action == 'productos') ? 'active' : ''; ?>">
        <i class="fas fa-box"></i> <span>Productos</span>
    </a>
    <a href="index.php?action=producto_crear" class="nav-item nav-sub scroll-preserve">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Producto</span>
    </a>
    
    <a href="index.php?action=empleados" class="nav-item scroll-preserve <?php echo ($current_action == 'empleados') ? 'active' : ''; ?>">
        <i class="fas fa-user-tie"></i> <span>Empleados</span>
    </a>
    <a href="index.php?action=empleado_crear" class="nav-item nav-sub scroll-preserve">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Empleado</span>
    </a>
    
    <a href="index.php?action=pedidos" class="nav-item scroll-preserve <?php echo ($current_action == 'pedidos') ? 'active' : ''; ?>">
        <i class="fas fa-shopping-cart"></i> <span>Pedidos</span>
    </a>
    <a href="index.php?action=pedido_crear" class="nav-item nav-sub scroll-preserve">
        <i class="fas fa-plus-circle"></i> <span>Nuevo Pedido</span>
    </a>
    
    <hr class="nav-divider">
    
    <div class="nav-title">ANALÍTICAS</div>
    
    <a href="index.php?action=consultas_pedidos_clientes" class="nav-item scroll-preserve">
        <i class="fas fa-receipt"></i> <span>Pedidos x Cliente</span>
    </a>
    <a href="index.php?action=consultas_productos_vendidos" class="nav-item scroll-preserve">
        <i class="fas fa-chart-line"></i> <span>Productos Vendidos</span>
    </a>
    <a href="index.php?action=consultas_pedidos_por_cliente" class="nav-item scroll-preserve">
        <i class="fas fa-user"></i> <span>Pedidos por Cliente</span>
    </a>
    <a href="index.php?action=consultas_detalle_pedido" class="nav-item scroll-preserve">
        <i class="fas fa-info-circle"></i> <span>Detalle Pedido</span>
    </a>
    <a href="index.php?action=consultas_pedidos_por_fecha" class="nav-item scroll-preserve">
        <i class="fas fa-calendar"></i> <span>Pedidos por Fecha</span>
    </a>
    <a href="index.php?action=consultas_recaudado_producto" class="nav-item scroll-preserve">
        <i class="fas fa-dollar-sign"></i> <span>Recaudado x Producto</span>
    </a>
    <a href="index.php?action=consultas_empleados_por_pedido" class="nav-item scroll-preserve">
        <i class="fas fa-truck"></i> <span>Empleados x Pedido</span>
    </a>
    
    <hr class="nav-divider">
    
    <!-- Reloj -->
    <div class="text-center py-3" style="font-size: 0.7rem; color: #a0aec0;">
        <i class="far fa-clock"></i> <span id="reloj"></span>
    </div>
</div>

<!-- Contenido principal -->
<div class="main-content" id="mainContent">

<script>
function actualizarReloj() {
    var reloj = document.getElementById('reloj');
    if (reloj) {
        var ahora = new Date();
        reloj.textContent = ahora.toLocaleString('es-ES');
    }
}
setInterval(actualizarReloj, 1000);
actualizarReloj();

// Guardar posición del scroll
(function() {
    var enlaces = document.querySelectorAll('.scroll-preserve');
    
    enlaces.forEach(function(enlace) {
        enlace.addEventListener('click', function(e) {
            var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
            var currentPage = window.location.pathname + window.location.search;
            sessionStorage.setItem('scrollPosition_' + currentPage, scrollPos);
            
            var href = this.getAttribute('href');
            if (href) {
                sessionStorage.setItem('scrollPosition_' + href.split('?')[0], scrollPos);
            }
        });
    });
    
    var savedScroll = sessionStorage.getItem('scrollPosition_' + window.location.pathname);
    if (savedScroll !== null) {
        setTimeout(function() {
            window.scrollTo(0, parseInt(savedScroll));
        }, 100);
    }
})();
</script>

<?php
if (isset($_GET['mensaje'])) {
    echo '<div class="alert alert-naranja-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> ' . htmlspecialchars($_GET['mensaje']) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
}

if (isset($_GET['error'])) {
    echo '<div class="alert alert-naranja-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> ' . htmlspecialchars($_GET['error']) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
}
?>

<script>
setTimeout(function() {
    var alertas = document.querySelectorAll('.alert');
    alertas.forEach(function(alerta) {
        alerta.style.transition = 'opacity 0.5s';
        alerta.style.opacity = '0';
        setTimeout(function() { alerta.remove(); }, 500);
    });
}, 4000);
</script>