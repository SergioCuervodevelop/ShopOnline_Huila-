<h2>Recaudado por Producto</h2>
<table class="table-naranja">
    <thead><tr><th>Producto</th><th>Cantidad Vendida</th><th>Total Recaudado</th></tr></thead>
    <tbody>
        <?php foreach($resultados as $r): ?>
        <tr>
            <td><?= $r['nombre'] ?></td>
            <td><?= $r['vendidos'] ?></td>
            <td>$<?= number_format($r['recaudado'],0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>