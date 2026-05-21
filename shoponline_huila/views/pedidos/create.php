<div class="card-naranja">
    <div class="card-header-naranja">Nuevo Pedido</div>
    <div class="p-3">
        <form method="POST" action="index.php?action=pedido_guardar" id="pedidoForm">
            <div class="mb-2">
                <select name="id_cliente" class="form-control" required>
                    <option value="">Seleccione Cliente</option>
                    <?php foreach($clientes as $c): ?>
                        <option value="<?= $c['id_cliente'] ?>"><?= $c['nombre'] . ' ' . $c['apellido'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2"><input type="text" name="direccion_envio" class="form-control" placeholder="Dirección de envío" required></div>
            <div class="mb-2">
                <select name="id_empleado" class="form-control" required>
                    <option value="">Empleado que despacha</option>
                    <?php foreach($empleados as $e): ?>
                        <option value="<?= $e['id_empleado'] ?>"><?= $e['nombre'] . ' ' . $e['apellido'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <select name="metodo_pago" class="form-control" required>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="transferencia">Transferencia</option>
                </select>
            </div>
            
            <h5>Productos</h5>
            <div id="productos-container">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <select name="productos[0][id_producto]" class="form-control" required>
                            <option value="">Producto</option>
                            <?php foreach($productos as $prod): ?>
                                <option value="<?= $prod['id_producto'] ?>"><?= $prod['nombre'] ?> - $<?= number_format($prod['precio'],0,',','.') ?> (Stock: <?= $prod['stock'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4"><input type="number" name="productos[0][cantidad]" class="form-control" placeholder="Cantidad" min="1" required></div>
                    <div class="col-md-2"><button type="button" class="btn btn-danger eliminar">X</button></div>
                </div>
            </div>
            <button type="button" id="agregar" class="btn btn-secondary mb-3">+ Agregar otro producto</button>
            
            <button type="submit" class="btn-naranja">Guardar Pedido</button>
            <a href="index.php?action=pedidos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
let contador = 1;
document.getElementById('agregar').onclick = function() {
    let div = document.createElement('div');
    div.className = 'row mb-2';
    div.innerHTML = '<div class="col-md-6"><select name="productos['+contador+'][id_producto]" class="form-control" required><option value="">Producto</option><?php foreach($productos as $prod): ?><option value="<?= $prod['id_producto'] ?>"><?= $prod['nombre'] ?> - $<?= number_format($prod['precio'],0,',','.') ?></option><?php endforeach; ?></select></div><div class="col-md-4"><input type="number" name="productos['+contador+'][cantidad]" class="form-control" placeholder="Cantidad" min="1" required></div><div class="col-md-2"><button type="button" class="btn btn-danger eliminar">X</button></div>';
    document.getElementById('productos-container').appendChild(div);
    contador++;
};
document.addEventListener('click', function(e) {
    if(e.target.classList.contains('eliminar')) {
        if(document.querySelectorAll('.eliminar').length > 1) {
            e.target.closest('.row').remove();
        } else {
            alert('Debe haber al menos un producto');
        }
    }
});
</script>