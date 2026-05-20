<?php
//
?>

<div class="mb-4">
    <h2><i class="fas fa-dollar-sign"></i> Recaudado por Producto</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Inicio
    </a>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Reporte Financiero por Producto</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad Vendida</th>
                        <th>Total Recaudado</th>
                        <th>Contribución %</th>
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
                        $recaudadoTotal = 0;
                        foreach ($resultados as $row) {
                            $recaudadoTotal += $row['total_recaudado'];
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
                                        <span class="badge bg-primary">
                                            <i class="fas fa-box"></i> <?= $row['total_vendido'] ?> und
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">0 und</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <strong class="text-success">
                                        $<?= number_format($row['total_recaudado'], 0, ',', '.') ?>
                                    </strong>
                                </td>
                                <td>
                                    <div class="progress" style="height: 25px;">
                                        <?php 
                                        $porcentaje = ($recaudadoTotal > 0) ? ($row['total_recaudado'] / $recaudadoTotal) * 100 : 0;
                                        ?>
                                        <div class="progress-bar bg-success" role="progressbar" 
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
                        <td colspan="4" class="text-end"><strong>RECAUDADO TOTAL:</strong></td>
                        <td class="text-end">
                            <strong class="text-success">$<?= number_format($recaudadoTotal, 0, ',', '.') ?></strong>
                        </td>
                        <td class="text-end">100%</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <!-- Gráfico de barras simple -->
        <?php if (!empty($resultados) && $recaudadoTotal > 0): ?>
            <div class="alert alert-info mt-4">
                <h6><i class="fas fa-chart-line"></i> Top 3 Productos Más Rentables</h6>
                <ol>
                    <?php 
                    $ordenados = $resultados;
                    usort($ordenados, function($a, $b) {
                        return $b['total_recaudado'] - $a['total_recaudado'];
                    });
                    $top3 = array_slice($ordenados, 0, 3);
                    foreach ($top3 as $item): 
                        if ($item['total_recaudado'] > 0):
                    ?>
                        <li>
                            <strong><?= htmlspecialchars($item['nombre']) ?></strong> - 
                            $<?= number_format($item['total_recaudado'], 0, ',', '.') ?> 
                            (<?= $item['total_vendido'] ?> unidades)
                        </li>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </ol>
            </div>
        <?php endif; ?>
    </div>
</div>