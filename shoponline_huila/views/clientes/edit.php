<div class="card-naranja">
    <div class="card-header-naranja">Editar Cliente</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=cliente_actualizar&id=<?= $cliente['id_cliente'] ?>">
            <div class="mb-2"><input type="text" name="nombre" class="form-control" value="<?= $cliente['nombre'] ?>" required></div>
            <div class="mb-2"><input type="text" name="apellido" class="form-control" value="<?= $cliente['apellido'] ?>" required></div>
            <div class="mb-2"><input type="email" name="correo" class="form-control" value="<?= $cliente['correo'] ?>" required></div>
            <div class="mb-2"><input type="text" name="telefono" class="form-control" value="<?= $cliente['telefono'] ?>" required></div>
            <div class="mb-2"><textarea name="direccion" class="form-control" required><?= $cliente['direccion'] ?></textarea></div>
            <button type="submit" class="btn-naranja">Actualizar</button>
            <a href="index.php?action=clientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>