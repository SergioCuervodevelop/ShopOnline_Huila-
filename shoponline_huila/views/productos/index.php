<div class="d-flex justify-content-between mb-3">
    <h2>Productos</h2>
    <a href="index.php?action=producto_crear" class="btn-naranja">+ Nuevo Producto</a>
</div>

<table class="table-naranja">
    <thead><tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr></thead>
    <tbody>
        <?php foreach($productos as $p): ?>
        <tr>
            <td><?= $p['id_producto'] ?></td>
            <td><?= $p['nombre'] ?></td>
            <td><?= $p['nombre_categoria'] ?></td>
            <td>$<?= number_format($p['precio'],0,',','.') ?></td>
            <td><?= $p['stock'] ?></td>
            <td>
                <a href="index.php?action=producto_editar&id=<?= $p['id_producto'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="index.php?action=producto_eliminar&id=<?= $p['id_producto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>