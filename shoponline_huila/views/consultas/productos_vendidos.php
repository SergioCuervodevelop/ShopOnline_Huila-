<?php
//
?>

<div class="mb-4">
    <h2><i class="fas fa-chart-line"></i> Productos y Cantidad Total Vendida</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Inicio
    </a>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Reporte de Ventas por Producto</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre del Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad Vendida</th>
                        <th>Ingresos Generados</th>
                        <th>% de Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($resultados)): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle"></i> No hay productos con ventas registradas
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php 
                        $totalVendidoGeneral = 0;
                        foreach ($resultados as $row) {
                            $totalVendidoGeneral += $row['total_vendido'];
                        }
                        ?>
                        <?php foreach ($resultados as $row): ?>
                            <tr>
                                <td class="text-center"><?= $row['id_producto'] ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($row['nombre']) ?></strong>
                                </td>
                                <td class="text-end">$<?= number_format($row['precio'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <?php if ($row['total_vendido'] > 0): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-box"></i> <?= $row['total_vendido'] ?> unidades
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">0 unidades</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <strong>$<?= number_format($row['total_vendido'] * $row['precio'], 0, ',', '.') ?></strong>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    $porcentaje = ($totalVendidoGeneral > 0) ? ($row['total_vendido'] / $totalVendidoGeneral) * 100 : 0;
                                    ?>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-info" role="progressbar" 
                                             style="width: <?= $porcentaje ?>%;" 
                                             aria-valuenow="<?= $porcentaje ?>" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            <?= round($porcentaje, 1) ?>%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <td colspan="3" class="text-end"><strong>Totales:</strong></td>
                        <td class="text-center">
                            <strong><?= $totalVendidoGeneral ?> unidades</strong>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Producto más vendido -->
<?php if (!empty($resultados)): 
    $masVendido = $resultados[0];
    foreach ($resultados as $row) {
        if ($row['total_vendido'] > $masVendido['total_vendido']) {
            $masVendido = $row;
        }
    }
?>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-trophy"></i> Producto Más Vendido
                </h5>
                <h3><?= htmlspecialchars($masVendido['nombre']) ?></h3>
                <p class="mb-0">
                    <?= $masVendido['total_vendido'] ?> unidades vendidas
                    <br>
                    $<?= number_format($masVendido['total_vendido'] * $masVendido['precio'], 0, ',', '.') ?> en ventas
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-chart-simple"></i> Resumen
                </h5>
                <p class="mb-0">
                    Total de unidades vendidas: <strong><?= $totalVendidoGeneral ?></strong><br>
                    Total de productos diferentes: <strong><?= count($resultados) ?></strong>
                </p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>