<h2>Detalle de Pedido</h2>
<form method="GET" class="mb-3">
    <input type="hidden" name="action" value="consultas_detalle_pedido">
    <input type="number" name="id_pedido" class="form-control w-50 d-inline" placeholder="Número de pedido" required>
    <button type="submit" class="btn-naranja">Buscar</button>
</form>

<?php if($pedido): ?>
    <p><strong>Pedido #<?= $pedido['id_pedido'] ?></strong></p>
    <p>Cliente: <?= $pedido['cliente'] ?></p>
    <p>Dirección: <?= $pedido['direccion_envio'] ?></p>
    <p>Total: $<?= number_format($pedido['total'],0,',','.') ?></p>
    <h5>Productos</h5>
    <table class="table-naranja">
        <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr></thead>
        <tbody>
            <?php foreach($productos as $prod): ?>
            <tr>
                <td><?= $prod['nombre'] ?></td>
                <td><?= $prod['cantidad'] ?></td>
                <td>$<?= number_format($prod['precio_unitario'],0,',','.') ?></td>
                <td>$<?= number_format($prod['subtotal'],0,',','.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>