<?php
//
?>

<div class="mb-4">
    <h2><i class="fas fa-calendar-alt"></i> Pedidos por Fecha</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Inicio
    </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Seleccionar Fecha</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="index.php" class="row g-3">
            <input type="hidden" name="action" value="consultas_pedidos_por_fecha">
            <div class="col-md-8">
                <input type="date" name="fecha" class="form-control" value="<?= $fecha ?>" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Consultar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">
            <i class="fas fa-chart-bar"></i> 
            Resultados para: <?= date('d/m/Y', strtotime($fecha)) ?>
        </h5>
    </div>
    <div class="card-body">
        <?php if (empty($resultados)): ?>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> 
                No hay pedidos registrados en la fecha <?= date('d/m/Y', strtotime($fecha)) ?>.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Pedido</th>
                            <th>Cliente</th>
                            <th>Fecha Pedido</th>
                            <th>Total</th>
                            <th>Método de Pago</th>
                            <th>Valor Pagado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalDia = 0;
                        foreach ($resultados as $row): 
                            $totalDia += $row['valor_pago'];
                        ?>
                            <tr>
                                <td class="text-center">#<?= $row['id_pedido'] ?></td>
                                <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido']) ?></td>
                                <td><?= date('H:i:s', strtotime($row['fecha_pedido'])) ?></td>
                                <td class="text-end">$<?= number_format($row['total'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <?php
                                    $metodoIcon = match($row['metodo_pago']) {
                                        'tarjeta' => 'fa-credit-card',
                                        'efectivo' => 'fa-money-bill',
                                        'transferencia' => 'fa-university',
                                        default => 'fa-receipt'
                                    };
                                    ?>
                                    <i class="fas <?= $metodoIcon ?>"></i>
                                    <?= ucfirst($row['metodo_pago']) ?>
                                </td>
                                <td class="text-end">$<?= number_format($row['valor_pago'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <span class="badge bg-success"><?= ucfirst($row['estado']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <td colspan="3" class="text-end"><strong>Totales del día:</strong></td>
                            <td class="text-end">
                                <strong>$<?= number_format($totalDia, 0, ',', '.') ?></strong>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Cantidad de pedidos:</strong></td>
                            <td class="text-end">
                                <strong><?= count($resultados) ?> pedidos</strong>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Resumen por método de pago -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6><i class="fas fa-chart-pie"></i> Resumen por Método de Pago</h6>
                            <div class="row">
                                <?php
                                $metodos = [];
                                foreach ($resultados as $row) {
                                    $metodo = $row['metodo_pago'];
                                    if (!isset($metodos[$metodo])) {
                                        $metodos[$metodo] = ['cantidad' => 0, 'total' => 0];
                                    }
                                    $metodos[$metodo]['cantidad']++;
                                    $metodos[$metodo]['total'] += $row['valor_pago'];
                                }
                                ?>
                                <?php foreach ($metodos as $metodo => $datos): ?>
                                    <div class="col-md-4">
                                        <div class="alert alert-info">
                                            <strong><?= ucfirst($metodo) ?>:</strong><br>
                                            <?= $datos['cantidad'] ?> pedido(s)<br>
                                            $<?= number_format($datos['total'], 0, ',', '.') ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>