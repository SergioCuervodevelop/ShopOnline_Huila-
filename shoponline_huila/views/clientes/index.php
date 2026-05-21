<div class="d-flex justify-content-between mb-3">
    <h2>Clientes</h2>
    <a href="index.php?action=cliente_crear" class="btn-naranja">+ Nuevo Cliente</a>
</div>

<table class="table-naranja">
    <thead>
        <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $c): ?>
        <tr>
            <td><?= $c['id_cliente'] ?></td>
            <td><?= $c['nombre'] . ' ' . $c['apellido'] ?></td>
            <td><?= $c['correo'] ?></td>
            <td><?= $c['telefono'] ?></td>
            <td>
                <a href="index.php?action=cliente_editar&id=<?= $c['id_cliente'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="index.php?action=cliente_eliminar&id=<?= $c['id_cliente'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>