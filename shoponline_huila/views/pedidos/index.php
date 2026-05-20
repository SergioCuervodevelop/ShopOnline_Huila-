<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Listado de Pedidos</h2>
    <a href="index.php?action=pedido_crear" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Pedido
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pedidos)): ?>
                <tr>
                    <td colspan="6" class="text-center">No hay pedidos registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td>#<?= $pedido['id_pedido'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])) ?></td>
                        <td><?= htmlspecialchars($pedido['nombre'] . ' ' . $pedido['apellido']) ?></td>
                        <td>$<?= number_format($pedido['total'], 0, ',', '.') ?></td>
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
                        <td>
                            <a href="index.php?action=pedido_ver&id=<?= $pedido['id_pedido'] ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>