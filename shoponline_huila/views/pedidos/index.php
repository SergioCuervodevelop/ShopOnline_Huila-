<div class="d-flex justify-content-between mb-3">
    <h2>Pedidos</h2>
    <a href="index.php?action=pedido_crear" class="btn-naranja">+ Nuevo Pedido</a>
</div>

<table class="table-naranja">
    <thead><tr><th>ID</th><th>Fecha</th><th>Cliente</th><th>Total</th><th>Estado</th><th>Acciones</th></tr></thead>
    <tbody>
        <?php foreach($pedidos as $p): ?>
        <tr>
            <td>#<?= $p['id_pedido'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($p['fecha_pedido'])) ?></td>
            <td><?= $p['nombre'] . ' ' . $p['apellido'] ?></td>
            <td>$<?= number_format($p['total'],0,',','.') ?></td>
            <td><span class="badge-naranja-warning"><?= $p['estado'] ?></span></td>
            <td><a href="index.php?action=pedido_ver&id=<?= $p['id_pedido'] ?>" class="btn btn-sm btn-info">Ver</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>