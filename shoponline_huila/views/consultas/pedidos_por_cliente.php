<h2>Pedidos por Cliente</h2>
<form method="GET" class="mb-3">
    <input type="hidden" name="action" value="consultas_pedidos_por_cliente">
    <select name="id_cliente" class="form-control w-50 d-inline" required>
        <option value="">Seleccione Cliente</option>
        <?php foreach($clientes as $c): ?>
            <option value="<?= $c['id_cliente'] ?>" <?= ($id_cliente == $c['id_cliente']) ? 'selected' : '' ?>><?= $c['nombre'] . ' ' . $c['apellido'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn-naranja">Consultar</button>
</form>

<?php if($cliente_info): ?>
    <h4>Cliente: <?= $cliente_info['nombre'] . ' ' . $cliente_info['apellido'] ?></h4>
    <table class="table-naranja">
        <thead><tr><th>ID Pedido</th><th>Fecha</th><th>Total</th></tr></thead>
        <tbody>
            <?php foreach($pedidos as $p): ?>
            <tr>
                <td>#<?= $p['id_pedido'] ?></td>
                <td><?= $p['fecha_pedido'] ?></td>
                <td>$<?= number_format($p['total'],0,',','.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>