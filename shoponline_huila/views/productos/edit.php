<div class="card-naranja">
    <div class="card-header-naranja">Editar Producto</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=producto_actualizar&id=<?= $producto['id_producto'] ?>">
            <div class="mb-2"><input type="text" name="nombre" class="form-control" value="<?= $producto['nombre'] ?>" required></div>
            <div class="mb-2"><input type="number" name="precio" class="form-control" value="<?= $producto['precio'] ?>" step="0.01" required></div>
            <div class="mb-2"><input type="number" name="stock" class="form-control" value="<?= $producto['stock'] ?>" required></div>
            <div class="mb-2">
                <select name="id_categoria" class="form-control" required>
                    <?php foreach($categorias as $c): ?>
                        <option value="<?= $c['id_categoria'] ?>" <?= ($c['id_categoria'] == $producto['id_categoria']) ? 'selected' : '' ?>><?= $c['nombre_categoria'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-naranja">Actualizar</button>
            <a href="index.php?action=productos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>