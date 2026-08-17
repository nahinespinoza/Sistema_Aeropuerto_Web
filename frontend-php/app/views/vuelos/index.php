<<?php
$vuelos  = $vuelos  ?? [];
$filtros = $filtros ?? ['fecha' => '', 'origen' => '', 'destino' => ''];
$error   = $error   ?? null;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-airplane me-2"></i>Vuelos</h2>
    <a href="<?= url('?page=vuelos&action=create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Registrar Vuelo
    </a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php endif; ?>

<!-- Filtros de búsqueda -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <input type="hidden" name="page" value="vuelos">

            <div class="col-md-3">
                <label class="form-label">Fecha de salida</label>
                <input type="date" name="fecha" class="form-control"
                       value="<?= e($filtros['fecha'] ?? '') ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label">Ciudad origen</label>
                <input type="text" name="origen" class="form-control"
                       placeholder="Ej: Guayaquil"
                       value="<?= e($filtros['origen'] ?? '') ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label">Ciudad destino</label>
                <input type="text" name="destino" class="form-control"
                       placeholder="Ej: Quito"
                       value="<?= e($filtros['destino'] ?? '') ?>">
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de resultados -->
<div class="card">
    <div class="card-body p-0">
        <?php if (empty($vuelos)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox display-4 d-block mb-2"></i>
                No se encontraron vuelos.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nº Vuelo</th>
                            <th>Aerolínea</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Salida</th>
                            <th>Llegada</th>
                            <th>Distancia</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vuelos as $v): ?>
                            <tr>
                                <td><strong><?= e($v['numeroVuelo'] ?? '-') ?></strong></td>
                                <td><?= e($v['aerolinea']['nombre'] ?? $v['aerolinea']['codigo'] ?? '-') ?></td>
                                <td>
                                    <?= e($v['origen']['ciudad'] ?? '-') ?>
                                    <small class="text-muted">(<?= e($v['origen']['codigo'] ?? '') ?>)</small>
                                </td>
                                <td>
                                    <?= e($v['destino']['ciudad'] ?? '-') ?>
                                    <small class="text-muted">(<?= e($v['destino']['codigo'] ?? '') ?>)</small>
                                </td>
                                <td><?= isset($v['horaSalida']) ? date('d/m/Y H:i', strtotime($v['horaSalida'])) : '-' ?></td>
                                <td><?= isset($v['horaLlegada']) ? date('d/m/Y H:i', strtotime($v['horaLlegada'])) : '-' ?></td>
                                <td><?= e($v['distancia'] ?? '-') ?> km</td>
                                <td>
                                    <?php if (!empty($v['activo'])): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?= url('?page=vuelos&action=show&id=' . ($v['id'] ?? '')) ?>"
                                       class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if (!empty($v['activo'])): ?>
                                        <a href="<?= url('?page=vuelos&action=desactivar&id=' . ($v['id'] ?? '')) ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('¿Desactivar este vuelo?')"
                                           title="Desactivar">
                                            <i class="bi bi-x-circle"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>