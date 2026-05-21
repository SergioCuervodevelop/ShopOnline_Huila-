<div class="card-naranja">
    <div class="card-header-naranja">Nuevo Empleado</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=empleado_guardar">
            <div class="mb-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
            <div class="mb-2"><input type="text" name="apellido" class="form-control" placeholder="Apellido" required></div>
            <div class="mb-2"><input type="text" name="cargo" class="form-control" placeholder="Cargo" required></div>
            <div class="mb-2"><input type="number" name="salario" class="form-control" placeholder="Salario" step="0.01" required></div>
            <div class="mb-2"><input type="date" name="fecha_ingreso" class="form-control" required></div>
            <button type="submit" class="btn-naranja">Guardar</button>
            <a href="index.php?action=empleados" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>