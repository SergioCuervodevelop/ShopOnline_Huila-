<?php
//
?>

<div class="mb-4">
    <h2>Editar Producto</h2>
    <a href="index.php?action=productos" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="index.php?action=producto_actualizar&id=<?= $producto['id_producto'] ?>">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           value="<?= htmlspecialchars($producto['nombre']) ?>" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="precio" class="form-label">Precio *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="precio" name="precio" 
                               step="0.01" min="0" required value="<?= $producto['precio'] ?>">
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Stock / Cantidad disponible *</label>
                    <input type="number" class="form-control" id="stock" name="stock" 
                           min="0" required value="<?= $producto['stock'] ?>">
                    <small class="text-muted">Unidades disponibles en inventario</small>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoría *</label>
                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                        <option value="">-- Seleccione una categoría --</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id_categoria'] ?>"
                                <?= ($categoria['id_categoria'] == $producto['id_categoria']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Información actual</label>
                    <div class="alert alert-info">
                        <strong><?= htmlspecialchars($producto['nombre']) ?></strong><br>
                        Precio: $<?= number_format($producto['precio'], 0, ',', '.') ?><br>
                        Stock actual: <?= $producto['stock'] ?> unidades
                    </div>
                </div>
            </div>
            
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> <strong>Nota:</strong>
                Cambiar el stock de un producto afectará los pedidos futuros, pero no los ya realizados.
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar Producto
            </button>
            <a href="index.php?action=productos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>