<div class="card-naranja">
    <div class="card-header-naranja">Pedido #<?= $pedido['id_pedido'] ?></div>
    <div class="p-3">
        <p><strong>Cliente:</strong> <?= $pedido['nombre'] . ' ' . $pedido['apellido'] ?></p>
        <p><strong>Correo:</strong> <?= $pedido['correo'] ?></p>
        <p><strong>Teléfono:</strong> <?= $pedido['telefono'] ?></p>
        <p><strong>Dirección:</strong> <?= $pedido['direccion_envio'] ?></p>
        <p><strong>Fecha:</strong> <?= $pedido['fecha_pedido'] ?></p>
        <p><strong>Total:</strong> $<?= number_format($pedido['total'],0,',','.') ?></p>
        
        <h5>Productos</h5>
        <table class="table">
            <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr></thead>
            <tbody>
                <?php foreach($detalles as $d): ?>
                <tr>
                    <td><?= $d['nombre'] ?></td>
                    <td><?= $d['cantidad'] ?></td>
                    <td>$<?= number_format($d['precio_unitario'],0,',','.') ?></td>
                    <td>$<?= number_format($d['subtotal'],0,',','.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?action=pedidos" class="btn btn-secondary">Volver</a>
    </div>
</div>