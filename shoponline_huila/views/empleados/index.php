<div class="d-flex justify-content-between mb-3">
    <h2>Empleados</h2>
    <a href="index.php?action=empleado_crear" class="btn-naranja">+ Nuevo Empleado</a>
</div>

<table class="table-naranja">
    <thead><tr><th>ID</th><th>Nombre</th><th>Cargo</th><th>Salario</th><th>Fecha Ingreso</th><th>Acciones</th></tr></thead>
    <tbody>
        <?php foreach($empleados as $e): ?>
        <tr>
            <td><?= $e['id_empleado'] ?></td>
            <td><?= $e['nombre'] . ' ' . $e['apellido'] ?></td>
            <td><?= $e['cargo'] ?></td>
            <td>$<?= number_format($e['salario'],0,',','.') ?></td>
            <td><?= $e['fecha_ingreso'] ?></td>
            <td>
                <a href="index.php?action=empleado_editar&id=<?= $e['id_empleado'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="index.php?action=empleado_eliminar&id=<?= $e['id_empleado'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>