<?php
//
?>

<div class="mb-4">
    <h2><i class="fas fa-user-plus"></i> Nuevo Empleado</h2>
    <a href="index.php?action=empleados" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Formulario de Registro de Empleado</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?action=empleado_guardar">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           placeholder="Ej: Juan Carlos" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido *</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" 
                           placeholder="Ej: Pérez González" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="cargo" class="form-label">Cargo *</label>
                    <select class="form-control" id="cargo" name="cargo" required>
                        <option value="">-- Seleccione un cargo --</option>
                        <option value="Despachador">Despachador</option>
                        <option value="Empaquetador">Empaquetador</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Atención al Cliente">Atención al Cliente</option>
                        <option value="Logística">Logística</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="salario" class="form-label">Salario *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="salario" name="salario" 
                               step="0.01" min="0" required placeholder="1.300.000">
                    </div>
                    <small class="text-muted">Salario mensual en pesos colombianos</small>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso *</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" 
                           value="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
            
            <hr>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> <strong>Información importante:</strong>
                <ul class="mb-0 mt-2">
                    <li>Los empleados registrados podrán ser asignados a envíos de pedidos</li>
                    <li>El salario se utilizará para cálculos de nómina</li>
                    <li>La fecha de ingreso se usará para calcular la antigüedad</li>
                </ul>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Empleado
                </button>
                <a href="index.php?action=empleados" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
// Validación del salario
document.getElementById('salario').addEventListener('input', function() {
    let valor = parseInt(this.value);
    if (valor < 1300000) {
        this.classList.add('is-invalid');
        document.getElementById('salario-error').style.display = 'block';
    } else {
        this.classList.remove('is-invalid');
        document.getElementById('salario-error').style.display = 'none';
    }
});
</script>

<div id="salario-error" class="text-danger small mt-1" style="display: none;">
    El salario mínimo en Colombia es de $1.300.000
</div>