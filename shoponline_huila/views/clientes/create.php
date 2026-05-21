<div class="card-naranja">
    <div class="card-header-naranja">Nuevo Cliente</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=cliente_guardar">
            <div class="mb-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
            <div class="mb-2"><input type="text" name="apellido" class="form-control" placeholder="Apellido" required></div>
            <div class="mb-2"><input type="email" name="correo" class="form-control" placeholder="Correo" required></div>
            <div class="mb-2"><input type="text" name="telefono" class="form-control" placeholder="Teléfono" required></div>
            <div class="mb-2"><textarea name="direccion" class="form-control" placeholder="Dirección" required></textarea></div>
            <button type="submit" class="btn-naranja">Guardar</button>
            <a href="index.php?action=clientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>