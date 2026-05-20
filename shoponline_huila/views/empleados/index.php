<?php
//
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user-tie"></i> Listado de Empleados</h2>
    <a href="index.php?action=empleado_crear" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Empleado
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Cargo</th>
                <th>Salario</th>
                <th>Fecha de Ingreso</th>
                <th>Antigüedad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($empleados)): ?>
                <tr>
                    <td colspan="7" class="text-center">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i> No hay empleados registrados.
                            <a href="index.php?action=empleado_crear" class="alert-link">Registrar el primer empleado</a>
                        </div>
                     </td>
                </tr>
            <?php else: ?>
                <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td><?= $empleado['id_empleado'] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($empleado['nombre']) ?></strong>
                            <br>
                            <small class="text-muted"><?= htmlspecialchars($empleado['apellido']) ?></small>
                         </td>
                        <td>
                            <?php
                            $cargoClass = match($empleado['cargo']) {
                                'Despachador' => 'bg-primary',
                                'Supervisor' => 'bg-success',
                                'Gerente' => 'bg-danger',
                                'Empaquetador' => 'bg-info',
                                default => 'bg-secondary'
                            };
                            ?>
                            <span class="badge <?= $cargoClass ?>"><?= htmlspecialchars($empleado['cargo']) ?></span>
                         </td>
                        <td class="text-end">
                            <strong>$<?= number_format($empleado['salario'], 0, ',', '.') ?></strong>
                         </td>
                        <td>
                            <?= date('d/m/Y', strtotime($empleado['fecha_ingreso'])) ?>
                         </td>
                        <td>
                            <?php
                            $fechaIngreso = new DateTime($empleado['fecha_ingreso']);
                            $hoy = new DateTime();
                            $antiguedad = $fechaIngreso->diff($hoy);
                            $anos = $antiguedad->y;
                            $meses = $antiguedad->m;
                            
                            if ($anos > 0) {
                                echo "<span class='badge bg-success'>{$anos} año(s)</span>";
                            } elseif ($meses > 0) {
                                echo "<span class='badge bg-info'>{$meses} mes(es)</span>";
                            } else {
                                echo "<span class='badge bg-secondary'>Reciente</span>";
                            }
                            ?>
                         </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="index.php?action=empleado_editar&id=<?= $empleado['id_empleado'] ?>" 
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?action=empleado_eliminar&id=<?= $empleado['id_empleado'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('¿Está seguro de eliminar este empleado?\nEsta acción no se puede deshacer.')"
                                   title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                         </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot class="table-secondary">
            <tr>
                <td colspan="7" class="text-end">
                    <strong>Total empleados: <?= count($empleados) ?></strong>
                 </td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Tarjetas de resumen -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-users"></i> Total Empleados
                </h5>
                <h2><?= count($empleados) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-chart-line"></i> Nómina Mensual
                </h5>
                <h2>
                    <?php 
                    $totalSalarios = 0;
                    foreach ($empleados as $emp) {
                        $totalSalarios += $emp['salario'];
                    }
                    echo '$' . number_format($totalSalarios, 0, ',', '.');
                    ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-calendar"></i> Antigüedad Promedio
                </h5>
                <h2>
                    <?php
                    $totalAntiguedad = 0;
                    foreach ($empleados as $emp) {
                        $fechaIng = new DateTime($emp['fecha_ingreso']);
                        $hoy = new DateTime();
                        $diff = $fechaIng->diff($hoy);
                        $totalAntiguedad += $diff->days;
                    }
                    $promedioDias = count($empleados) > 0 ? floor($totalAntiguedad / count($empleados)) : 0;
                    $promedioMeses = floor($promedioDias / 30);
                    echo $promedioMeses . " meses";
                    ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-trophy"></i> Salario Promedio
                </h5>
                <h2>
                    <?php
                    $promedioSalario = count($empleados) > 0 ? $totalSalarios / count($empleados) : 0;
                    echo '$' . number_format($promedioSalario, 0, ',', '.');
                    ?>
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de cargos -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-briefcase"></i> Distribución por Cargos</h5>
            </div>
            <div class="card-body">
                <?php
                $cargos = [];
                foreach ($empleados as $emp) {
                    $cargo = $emp['cargo'];
                    if (!isset($cargos[$cargo])) {
                        $cargos[$cargo] = 0;
                    }
                    $cargos[$cargo]++;
                }
                ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Cargo</th>
                            <th>Cantidad</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cargos as $cargo => $cantidad): ?>
                            <tr>
                                <td><?= htmlspecialchars($cargo) ?></td>
                                <td><?= $cantidad ?></td>
                                <td>
                                    <?= round(($cantidad / count($empleados)) * 100, 1) ?>%
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Últimos Empleados Contratados</h5>
            </div>
            <div class="card-body">
                <?php
                // Ordenar por fecha de ingreso descendente
                $empleadosOrdenados = $empleados;
                usort($empleadosOrdenados, function($a, $b) {
                    return strtotime($b['fecha_ingreso']) - strtotime($a['fecha_ingreso']);
                });
                $recientes = array_slice($empleadosOrdenados, 0, 5);
                ?>
                <?php if (empty($recientes)): ?>
                    <p class="text-muted">No hay empleados registrados</p>
                <?php else: ?>
                    <ul class="list-group">
                        <?php foreach ($recientes as $emp): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= htmlspecialchars($emp['nombre'] . ' ' . $emp['apellido']) ?></strong>
                                    <br>
                                    <small class="text-muted"><?= htmlspecialchars($emp['cargo']) ?></small>
                                </div>
                                <span class="badge bg-primary rounded-pill">
                                    <?= date('d/m/Y', strtotime($emp['fecha_ingreso'])) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>