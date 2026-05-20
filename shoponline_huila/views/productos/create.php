<?php
//
?>

<div class="mb-4">
    <h2>Nuevo Producto</h2>
    <a href="index.php?action=productos" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="index.php?action=producto_guardar">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required 
                           placeholder="Ej: Smartphone Galaxy S21">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="precio" class="form-label">Precio *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="precio" name="precio" 
                               step="0.01" min="0" required placeholder="0.00">
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Stock / Cantidad disponible *</label>
                    <input type="number" class="form-control" id="stock" name="stock" 
                           min="0" required placeholder="0">
                    <small class="text-muted">Número de unidades disponibles en inventario</small>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoría *</label>
                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                        <option value="">-- Seleccione una categoría --</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id_categoria'] ?>">
                                <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Vista previa</label>
                    <div class="alert alert-info" id="vista-previa">
                        <strong>Resumen:</strong><br>
                        <span id="prev-nombre">-</span><br>
                        Precio: <span id="prev-precio">$0</span><br>
                        Stock: <span id="prev-stock">0</span> unidades
                    </div>
                </div>
            </div>
            
            <hr>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Producto
            </button>
            <a href="index.php?action=productos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
// Vista previa en tiempo real
document.getElementById('nombre').addEventListener('input', function() {
    document.getElementById('prev-nombre').innerText = this.value || '-';
});

document.getElementById('precio').addEventListener('input', function() {
    let valor = this.value || 0;
    document.getElementById('prev-precio').innerText = '$' + parseInt(valor).toLocaleString('es-CO');
});

document.getElementById('stock').addEventListener('input', function() {
    document.getElementById('prev-stock').innerText = this.value || 0;
});
</script>