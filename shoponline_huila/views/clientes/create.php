<div class="mb-4">
    <h2>Nuevo Cliente</h2>
    <a href="index.php?action=clientes" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="index.php?action=cliente_guardar">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido *</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono *</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="direccion" class="form-label">Dirección *</label>
                    <textarea class="form-control" id="direccion" name="direccion" rows="2" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Cliente
            </button>
            <a href="index.php?action=clientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>