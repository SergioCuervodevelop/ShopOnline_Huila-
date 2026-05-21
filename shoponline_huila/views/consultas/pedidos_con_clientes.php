<h2>Pedidos con Cliente</h2>
<table class="table-naranja">
    <thead><tr><th>ID</th><th>Fecha</th><th>Cliente</th><th>Total</th><th>Estado</th></tr></thead>
    <tbody>
        <?php foreach($resultados as $r): ?>
        <tr>
            <td>#<?= $r['id_pedido'] ?></td>
            <td><?= $r['fecha_pedido'] ?></td>
            <td><?= $r['cliente'] ?></td>
            <td>$<?= number_format($r['total'],0,',','.') ?></td>
            <td><?= $r['estado'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>