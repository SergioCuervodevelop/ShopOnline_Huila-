<div class="card-naranja">
    <div class="card-header-naranja">Nuevo Producto</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=producto_guardar">
            <div class="mb-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
            <div class="mb-2"><input type="number" name="precio" class="form-control" placeholder="Precio" step="0.01" required></div>
            <div class="mb-2"><input type="number" name="stock" class="form-control" placeholder="Stock" required></div>
            <div class="mb-2">
                <select name="id_categoria" class="form-control" required>
                    <option value="">Seleccione categoría</option>
                    <?php foreach($categorias as $c): ?>
                        <option value="<?= $c['id_categoria'] ?>"><?= $c['nombre_categoria'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-naranja">Guardar</button>
            <a href="index.php?action=productos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>