<h2>Pedidos por Fecha</h2>
<form method="GET" class="mb-3">
    <input type="hidden" name="action" value="consultas_pedidos_por_fecha">
    <input type="date" name="fecha" class="form-control w-50 d-inline" value="<?= $fecha ?>">
    <button type="submit" class="btn-naranja">Consultar</button>
</form>

<table class="table-naranja">
    <thead><tr><th>ID</th><th>Cliente</th><th>Total</th><th>Método Pago</th></tr></thead>
    <tbody>
        <?php foreach($resultados as $r): ?>
        <tr>
            <td>#<?= $r['id_pedido'] ?></td>
            <td><?= $r['nombre'] . ' ' . $r['apellido'] ?></td>
            <td>$<?= number_format($r['total'],0,',','.') ?></td>
            <td><?= $r['metodo_pago'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>