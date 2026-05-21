<div class="card-naranja">
    <div class="card-header-naranja">Editar Empleado</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=empleado_actualizar&id=<?= $empleado['id_empleado'] ?>">
            <div class="mb-2"><input type="text" name="nombre" class="form-control" value="<?= $empleado['nombre'] ?>" required></div>
            <div class="mb-2"><input type="text" name="apellido" class="form-control" value="<?= $empleado['apellido'] ?>" required></div>
            <div class="mb-2"><input type="text" name="cargo" class="form-control" value="<?= $empleado['cargo'] ?>" required></div>
            <div class="mb-2"><input type="number" name="salario" class="form-control" value="<?= $empleado['salario'] ?>" step="0.01" required></div>
            <div class="mb-2"><input type="date" name="fecha_ingreso" class="form-control" value="<?= $empleado['fecha_ingreso'] ?>" required></div>
            <button type="submit" class="btn-naranja">Actualizar</button>
            <a href="index.php?action=empleados" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>