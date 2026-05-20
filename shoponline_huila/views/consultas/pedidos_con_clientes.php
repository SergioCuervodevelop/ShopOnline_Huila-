<div class="mb-4">
    <h2>Consulta: Pedidos con Nombre del Cliente</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Inicio
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
            </tr>
        </thead>
        <tbody>
            <?php if (empty($resultados)): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay pedidos registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($resultados as $row): ?>
                    <tr>
                        <td>#<?= $row['id_pedido'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['fecha_pedido'])) ?></td>
                        <td><?= htmlspecialchars($row['cliente_nombre']) ?></td>
                        <td>$<?= number_format($row['total'], 0, ',', '.') ?></td>
                        <td><?= ucfirst($row['estado']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>