<?php
//
?>

<div class="fade-in">
    <div class="card-temu mb-4">
        <div class="card-header-temu">
            <i class="fas fa-truck"></i> Empleados que Despacharon un Pedido
        </div>
        <div class="p-4">
            <form method="GET" action="index.php" class="row g-3">
                <input type="hidden" name="action" value="consultas_empleados_por_pedido">
                <div class="col-md-8">
                    <input type="number" name="id_pedido" class="form-control form-control-temu" 
                           placeholder="Ingrese el número de pedido" 
                           value="<?php echo $id_pedido > 0 ? $id_pedido : ''; ?>" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-temu w-100">
                        <i class="fas fa-search"></i> Buscar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($id_pedido > 0): ?>
        <?php if ($pedido_info): ?>
            <div class="alert alert-temu-success mb-4">
                <i class="fas fa-info-circle"></i> 
                <strong>Pedido #<?php echo $id_pedido; ?></strong> - 
                Total: $<?php echo number_format($pedido_info['total'], 0, ',', '.'); ?> - 
                Estado: <?php echo ucfirst($pedido_info['estado']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (empty($empleados)): ?>
            <div class="alert alert-temu-danger">
                <i class="fas fa-exclamation-triangle"></i> 
                No se encontraron empleados asociados al despacho del pedido #<?php echo $id_pedido; ?>.
                <?php if (!$pedido_info): ?>
                    <br>Verifique que el número de pedido sea correcto.
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($empleados as $empleado): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card-temu">
                            <div class="card-header-temu" style="background: <?php echo $empleado['estado_envio'] == 'entregado' ? '#e6f7e6' : '#fff3e0'; ?>; border-bottom: none;">
                                <h5 class="mb-0" style="color: #1a202c;">
                                    <i class="fas fa-user-tie" style="color: #f97316;"></i> 
                                    <?php echo htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']); ?>
                                </h5>
                            </div>
                            <div class="p-4">
                                <table class="table-temu" style="width: 100%;">
                                    <tr>
                                        <td style="padding: 6px 0; width: 40%;"><strong>Cargo:</strong></td>
                                        <td style="padding: 6px 0;"><?php echo htmlspecialchars($empleado['cargo']); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0;"><strong>Salario:</strong></td>
                                        <td style="padding: 6px 0;">$<?php echo number_format($empleado['salario'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0;"><strong>Fecha de Envío:</strong></td>
                                        <td style="padding: 6px 0;">
                                            <?php echo $empleado['fecha_envio'] ? date('d/m/Y', strtotime($empleado['fecha_envio'])) : 'Pendiente'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0;"><strong>Estado del Envío:</strong></td>
                                        <td style="padding: 6px 0;">
                                            <?php
                                            $claseBadge = match($empleado['estado_envio']) {
                                                'preparando' => 'badge-temu-warning',
                                                'enviado' => 'badge-temu-info',
                                                'entregado' => 'badge-temu-success',
                                                default => 'badge-temu-warning'
                                            };
                                            ?>
                                            <span class="<?php echo $claseBadge; ?>">
                                                <?php echo ucfirst($empleado['estado_envio']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0;"><strong>Dirección:</strong></td>
                                        <td style="padding: 6px 0;"><?php echo htmlspecialchars($empleado['direccion_envio']); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Pedidos recientes -->
    <div class="card-temu mt-4">
        <div class="card-header-temu">
            <i class="fas fa-clock"></i> Pedidos Recientes
        </div>
        <div class="p-0">
            <?php if (empty($pedidosRecientes)): ?>
                <div class="p-4 text-center text-muted">
                    No hay pedidos registrados
                </div>
            <?php else: ?>
                <table class="table-temu" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidosRecientes as $p): ?>
                            <tr>
                                <td>#<?php echo $p['id_pedido']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($p['fecha_pedido'])); ?></td>
                                <td>$<?php echo number_format($p['total'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="index.php?action=consultas_empleados_por_pedido&id_pedido=<?php echo $p['id_pedido']; ?>" 
                                       class="btn-temu-outline" style="padding: 4px 12px; font-size: 0.7rem;">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>