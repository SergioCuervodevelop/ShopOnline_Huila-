<?php
//

<div class="fade-in">
    <div class="card-temu mb-4">
        <div class="card-header-temu">
            <i class="fas fa-user"></i> Pedidos por Cliente
        </div>
        <div class="p-4">
            <form method="GET" action="index.php" class="row g-3">
                <input type="hidden" name="action" value="consultas_pedidos_por_cliente">
                <div class="col-md-8">
                    <select name="id_cliente" class="form-control form-control-temu" required>
                        <option value="">-- Seleccione un cliente --</option>
                        <?php foreach ($clientes as $cli): ?>
                            <option value="<?php echo $cli['id_cliente']; ?>" 
                                <?php echo ($id_cliente == $cli['id_cliente']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cli['nombre'] . ' ' . $cli['apellido']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-temu w-100">
                        <i class="fas fa-search"></i> Consultar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($id_cliente > 0 && $cliente_info): ?>
        <div class="card-temu">
            <div class="card-header-temu">
                <i class="fas fa-user-circle"></i> 
                Cliente: <?php echo htmlspecialchars($cliente_info['nombre'] . ' ' . $cliente_info['apellido']); ?>
            </div>
            <div class="p-0">
                <?php if (empty($pedidos)): ?>
                    <div class="p-4 text-center text-muted">
                        Este cliente no tiene pedidos registrados.
                    </div>
                <?php else: ?>
                    <table class="table-temu" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $totalGastado = 0;
                            foreach ($pedidos as $pedido): 
                                $totalGastado += $pedido['total'];
                            ?>
                                <tr>
                                    <td>#<?php echo $pedido['id_pedido']; ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?></td>
                                    <td>$<?php echo number_format($pedido['total'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="<?php echo $pedido['estado'] == 'pagado' ? 'badge-temu-success' : 'badge-temu-warning'; ?>">
                                            <?php echo ucfirst($pedido['estado']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="index.php?action=consultas_detalle_pedido&id_pedido=<?php echo $pedido['id_pedido']; ?>" 
                                           class="btn-temu-outline" style="padding: 4px 12px; font-size: 0.7rem;">
                                            Ver Detalle
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot style="background: #fafafa;">
                            <tr>
                                <td colspan="2" style="padding: 12px;"><strong>Total Gastado:</strong></td>
                                <td colspan="3" style="padding: 12px;"><strong>$<?php echo number_format($totalGastado, 0, ',', '.'); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 12px;"><strong>Total Pedidos:</strong></td>
                                <td colspan="3" style="padding: 12px;"><strong><?php echo count($pedidos); ?> pedidos</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    <?php elseif ($id_cliente > 0 && !$cliente_info): ?>
        <div class="alert alert-temu-danger">
            <i class="fas fa-exclamation-circle"></i> Cliente no encontrado.
        </div>
    <?php endif; ?>
</div>