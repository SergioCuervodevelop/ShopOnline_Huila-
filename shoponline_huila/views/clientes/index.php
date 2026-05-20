<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Listado de Clientes</h2>
    <a href="index.php?action=cliente_crear" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Cliente
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($clientes)): ?>
                <tr>
                    <td colspan="7" class="text-center">No hay clientes registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id_cliente'] ?></td>
                        <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                        <td><?= htmlspecialchars($cliente['apellido']) ?></td>
                        <td><?= htmlspecialchars($cliente['correo']) ?></td>
                        <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                        <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                        <td>
                            <a href="index.php?action=cliente_ver&id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?action=cliente_editar&id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?action=cliente_eliminar&id=<?= $cliente['id_cliente'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Está seguro de eliminar este cliente?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>