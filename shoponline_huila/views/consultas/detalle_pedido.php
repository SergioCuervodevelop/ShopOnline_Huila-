<?php
//
?>

<div class="mb-4">
    <h2><i class="fas fa-receipt"></i> Detalle de Pedido</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Inicio
    </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Buscar Pedido</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="index.php" class="row g-3">
            <input type="hidden" name="action" value="consultas_detalle_pedido">
            <div class="col-md-8">
                <input type="number" name="id_pedido" class="form-control" 
                       placeholder="Ingrese el número de pedido" 
                       value="<?= $id_pedido > 0 ? $id_pedido : '' ?>" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </form>
    </div>
</div>

<?php if ($id_pedido > 0 && $pedido): ?>
    <!-- Información del Pedido y Cliente -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Información del Pedido</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Número de Pedido:</th>
                            <td><strong>#<?= $pedido['id_pedido'] ?></strong></td>
                        </tr>
                        <tr>
                            <th>Fecha del Pedido:</th>
                            <td><?= date('d/m/Y H:i:s', strtotime($pedido['fecha_pedido'])) ?></td>
                        </tr>
                        <tr>
                            <th>Total del Pedido:</th>
                            <td><strong class="text-success">$<?= number_format($pedido['total'], 0, ',', '.') ?></strong></td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <?php
                                $badgeClass = match($pedido['estado']) {
                                    'pendiente' => 'bg-warning',
                                    'pagado' => 'bg-info',
                                    'enviado' => 'bg-primary',
                                    'cancelado' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= ucfirst($pedido['estado']) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Información del Cliente</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nombre Completo:</th>
                            <td><strong><?= htmlspecialchars($pedido['cliente_nombre']) ?></strong></td>
                        </tr>
                        <tr>
                            <th>Correo Electrónico:</th>
                            <td><?= htmlspecialchars($pedido['correo']) ?></td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td><?= htmlspecialchars($pedido['telefono']) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Productos del Pedido -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-boxes"></i> Productos del Pedido</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $item): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($item['nombre']) ?></strong>
                                </td>
                                <td class="text-end">$<?= number_format($item['precio_unitario'], 0, ',', '.') ?></td>
                                <td class="text-center"><?= $item['cantidad'] ?></td>
                                <td class="text-end">$<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                            <td class="text-end">
                                <strong>$<?= number_format($pedido['total'], 0, ',', '.') ?></strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
<?php elseif ($id_pedido > 0 && !$pedido): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> 
        No se encontró el pedido #<?= $id_pedido ?>. Verifique el número ingresado.
    </div>
<?php endif; ?>