<?php
//

<div class="mb-4">
    <h2><i class="fas fa-user-edit"></i> Editar Empleado</h2>
    <a href="index.php?action=empleados" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Editando empleado: <?= htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']) ?></h5>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?action=empleado_actualizar&id=<?= $empleado['id_empleado'] ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           value="<?= htmlspecialchars($empleado['nombre']) ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido *</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" 
                           value="<?= htmlspecialchars($empleado['apellido']) ?>" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="cargo" class="form-label">Cargo *</label>
                    <select class="form-control" id="cargo" name="cargo" required>
                        <option value="">-- Seleccione un cargo --</option>
                        <option value="Despachador" <?= $empleado['cargo'] == 'Despachador' ? 'selected' : '' ?>>Despachador</option>
                        <option value="Empaquetador" <?= $empleado['cargo'] == 'Empaquetador' ? 'selected' : '' ?>>Empaquetador</option>
                        <option value="Supervisor" <?= $empleado['cargo'] == 'Supervisor' ? 'selected' : '' ?>>Supervisor</option>
                        <option value="Gerente" <?= $empleado['cargo'] == 'Gerente' ? 'selected' : '' ?>>Gerente</option>
                        <option value="Atención al Cliente" <?= $empleado['cargo'] == 'Atención al Cliente' ? 'selected' : '' ?>>Atención al Cliente</option>
                        <option value="Logística" <?= $empleado['cargo'] == 'Logística' ? 'selected' : '' ?>>Logística</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="salario" class="form-label">Salario *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="salario" name="salario" 
                               step="0.01" min="0" required value="<?= $empleado['salario'] ?>">
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso *</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" 
                           value="<?= $empleado['fecha_ingreso'] ?>" required>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <i class="fas fa-chart-line"></i> <strong>Información actual:</strong><br>
                        <strong>Antigüedad:</strong> 
                        <?php
                        $fechaIng = new DateTime($empleado['fecha_ingreso']);
                        $hoy = new DateTime();
                        $diff = $fechaIng->diff($hoy);
                        echo $diff->y . " años, " . $diff->m . " meses, " . $diff->d . " días";
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Nota:</strong>
                        Cambiar la información del empleado afectará los registros históricos de envíos.
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Empleado
                </button>
                <a href="index.php?action=empleados" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>