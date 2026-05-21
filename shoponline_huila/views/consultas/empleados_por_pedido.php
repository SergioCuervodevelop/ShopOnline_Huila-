<h2>Empleados que despacharon un pedido</h2>
<form method="GET" class="mb-3">
    <input type="hidden" name="action" value="consultas_empleados_por_pedido">
    <input type="number" name="id_pedido" class="form-control w-50 d-inline" placeholder="Número de pedido">
    <button type="submit" class="btn-naranja">Buscar</button>
</form>

<?php if($pedido_info): ?>
    <p><strong>Pedido #<?= $id_pedido ?></strong> - Total: $<?= number_format($pedido_info['total'],0,',','.') ?></p>
    <?php foreach($empleados as $e): ?>
        <div class="card-naranja mb-2">
            <div class="p-3">
                <strong><?= $e['nombre'] . ' ' . $e['apellido'] ?></strong><br>
                Cargo: <?= $e['cargo'] ?><br>
                Fecha envío: <?= $e['fecha_envio'] ?? 'Pendiente' ?><br>
                Estado: <?= $e['estado_envio'] ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<h5>Pedidos recientes</h5>
<ul>
    <?php foreach($recientes as $r): ?>
        <li><a href="?action=consultas_empleados_por_pedido&id_pedido=<?= $r['id_pedido'] ?>">Pedido #<?= $r['id_pedido'] ?> - <?= $r['fecha_pedido'] ?></a></li>
    <?php endforeach; ?>
</ul>