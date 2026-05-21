<h2>Productos Vendidos</h2>
<table class="table-naranja">
    <thead><tr><th>Producto</th><th>Precio</th><th>Cantidad Vendida</th></tr></thead>
    <tbody>
        <?php foreach($resultados as $r): ?>
        <tr>
            <td><?= $r['nombre'] ?></td>
            <td>$<?= number_format($r['precio'],0,',','.') ?></td>
            <td><?= $r['vendidos'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>