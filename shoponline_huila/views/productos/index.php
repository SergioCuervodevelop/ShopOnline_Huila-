<?php
//
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Listado de Productos</h2>
    <a href="index.php?action=producto_crear" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Producto
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($productos)): ?>
                <tr>
                    <td colspan="7" class="text-center">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i> No hay productos registrados.
                            <a href="index.php?action=producto_crear" class="alert-link">Crear el primer producto</a>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['id_producto'] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($producto['nombre']) ?></strong>
                            <br>
                            <small class="text-muted">ID: <?= $producto['id_producto'] ?></small>
                        </td>
                        <td>
                            <span class="badge bg-secondary"><?= htmlspecialchars($producto['nombre_categoria']) ?></span>
                        </td>
                        <td class="text-end">
                            $<?= number_format($producto['precio'], 0, ',', '.') ?>
                        </td>
                        <td class="text-center">
                            <?php if ($producto['stock'] <= 0): ?>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle"></i> Agotado
                                </span>
                            <?php elseif ($producto['stock'] <= 5): ?>
                                <span class="badge bg-warning">
                                    <i class="fas fa-exclamation-triangle"></i> <?= $producto['stock'] ?> unidades
                                </span>
                            <?php else: ?>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> <?= $producto['stock'] ?> unidades
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($producto['stock'] > 0): ?>
                                <span class="badge bg-success">Disponible</span>
                            <?php else: ?>
                                <span class="badge bg-danger">No disponible</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="index.php?action=producto_editar&id=<?= $producto['id_producto'] ?>" 
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?action=producto_eliminar&id=<?= $producto['id_producto'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('¿Está seguro de eliminar este producto?\nEsta acción no se puede deshacer.')"
                                   title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot class="table-secondary">
            <tr>
                <td colspan="7" class="text-end">
                    <strong>Total productos: <?= count($productos) ?></strong>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Resumen rápido -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Productos</h5>
                <h2><?= count($productos) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Productos Disponibles</h5>
                <h2>
                    <?php 
                    $disponibles = 0;
                    foreach ($productos as $p) {
                        if ($p['stock'] > 0) $disponibles++;
                    }
                    echo $disponibles;
                    ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Agotados</h5>
                <h2>
                    <?php 
                    $agotados = 0;
                    foreach ($productos as $p) {
                        if ($p['stock'] == 0) $agotados++;
                    }
                    echo $agotados;
                    ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Stock Bajo (≤5)</h5>
                <h2>
                    <?php 
                    $bajoStock = 0;
                    foreach ($productos as $p) {
                        if ($p['stock'] > 0 && $p['stock'] <= 5) $bajoStock++;
                    }
                    echo $bajoStock;
                    ?>
                </h2>
            </div>
        </div>
    </div>
</div>