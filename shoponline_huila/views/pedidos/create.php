<div class="mb-4">
    <h2>Nuevo Pedido</h2>
    <a href="index.php?action=pedidos" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="index.php?action=pedido_guardar" id="pedidoForm">
            <!-- Datos del cliente -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_cliente" class="form-label">Cliente *</label>
                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                        <option value="">Seleccione un cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id_cliente'] ?>">
                                <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="direccion_envio" class="form-label">Dirección de Envío *</label>
                    <input type="text" class="form-control" id="direccion_envio" name="direccion_envio" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="id_empleado" class="form-label">Empleado que despacha *</label>
                    <select class="form-control" id="id_empleado" name="id_empleado" required>
                        <option value="">Seleccione un empleado</option>
                        <?php foreach ($empleados as $empleado): ?>
                            <option value="<?= $empleado['id_empleado'] ?>">
                                <?= htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido'] . ' - ' . $empleado['cargo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago *</label>
                    <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                        <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia Bancaria</option>
                    </select>
                </div>
            </div>
            
            <hr>
            <h4>Productos del Pedido</h4>
            
            <div id="productos-container">
                <div class="row producto-item mb-2">
                    <div class="col-md-5">
                        <select name="productos[0][id_producto]" class="form-control producto-select" required>
                            <option value="">-- Seleccione producto --</option>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?= $producto['id_producto'] ?>" 
                                        data-precio="<?= $producto['precio'] ?>"
                                        data-stock="<?= $producto['stock'] ?>">
                                    <?= htmlspecialchars($producto['nombre']) ?> 
                                    (Stock: <?= $producto['stock'] ?>) - $<?= number_format($producto['precio'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="productos[0][cantidad]" class="form-control cantidad-input" 
                               placeholder="Cantidad" min="1" required>
                    </div>
                    <div class="col-md-2">
                        <span class="form-control bg-light subtotal">$0</span>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger eliminar-producto">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
            
            <button type="button" id="agregar-producto" class="btn btn-secondary mb-3">
                <i class="fas fa-plus"></i> Agregar otro producto
            </button>
            
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="text-end">Total del Pedido: <span id="total-pedido">$0</span></h5>
                            <input type="hidden" name="total" id="total-hidden" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Pedido
                </button>
                <a href="index.php?action=pedidos" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
// Contador para los índices de productos
let productoIndex = 1;

// Función para recalcular total
function recalcularTotal() {
    let total = 0;
    document.querySelectorAll('.producto-item').forEach(item => {
        const subtotalSpan = item.querySelector('.subtotal');
        if (subtotalSpan && subtotalSpan.innerText) {
            const valor = parseFloat(subtotalSpan.innerText.replace('$', '').replace(/\./g, '')) || 0;
            total += valor;
        }
    });
    document.getElementById('total-pedido').innerText = '$' + total.toLocaleString('es-CO');
    document.getElementById('total-hidden').value = total;
}

// Función para calcular subtotal de un producto
function calcularSubtotal(productoRow) {
    const select = productoRow.querySelector('.producto-select');
    const cantidadInput = productoRow.querySelector('.cantidad-input');
    const subtotalSpan = productoRow.querySelector('.subtotal');
    
    if (select.value && cantidadInput.value) {
        const precio = parseFloat(select.options[select.selectedIndex].getAttribute('data-precio'));
        const cantidad = parseInt(cantidadInput.value);
        const subtotal = precio * cantidad;
        subtotalSpan.innerText = '$' + subtotal.toLocaleString('es-CO');
    } else {
        subtotalSpan.innerText = '$0';
    }
    recalcularTotal();
}

// Eventos para productos existentes
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('eliminar-producto')) {
        const row = e.target.closest('.producto-item');
        if (document.querySelectorAll('.producto-item').length > 1) {
            row.remove();
            recalcularTotal();
        } else {
            alert('Debe haber al menos un producto en el pedido');
        }
    }
});

// Agregar nuevo producto
document.getElementById('agregar-producto').addEventListener('click', function() {
    const container = document.getElementById('productos-container');
    const template = document.querySelector('.producto-item').cloneNode(true);
    
    // Limpiar valores
    template.querySelector('.producto-select').value = '';
    template.querySelector('.cantidad-input').value = '';
    template.querySelector('.subtotal').innerText = '$0';
    
    // Actualizar names
    template.querySelector('.producto-select').name = `productos[${productoIndex}][id_producto]`;
    template.querySelector('.cantidad-input').name = `productos[${productoIndex}][cantidad]`;
    
    container.appendChild(template);
    productoIndex++;
});

// Eventos dinámicos para cambios
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('producto-select') || e.target.classList.contains('cantidad-input')) {
        const row = e.target.closest('.producto-item');
        calcularSubtotal(row);
    }
});
</script>