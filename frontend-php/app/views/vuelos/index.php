<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="bi bi-calendar-check me-2 text-info"></i>Vuelos</h1>
        <p class="text-muted mb-0">Búsqueda y consulta de vuelos disponibles</p>
    </div>
</div>

<!-- Filtros de búsqueda -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <input type="hidden" name="page" value="vuelos">
            <div class="col-md-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control"
                       value="<?= e($filtros['fecha'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Ciudad de origen</label>
                <input type="text" name="origen" class="form-control"
                       placeholder="Ej: Bogotá" value="<?= e($filtros['origen'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Ciudad de destino</label>
                <input type="text" name="destino" class="form-control"
                       placeholder="Ej: Madrid" value="<?= e($filtros['destino'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-info text-white me-2">
                    <i class="bi bi-search me-1"></i>Buscar
                </button>
                <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i><?= e($error) ?>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($vuelos)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                No se encontraron vuelos con los filtros aplicados.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nº Vuelo</th>
                            <th>Origen → Destino</th>
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
                                <td>
                                    <span class="badge bg-info text-dark fs-6">
                                        <?= e($v['numeroVuelo'] ?? '') ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $origen  = $v['origen']['ciudad']  ?? ($v['origen']['codigo']  ?? '?');
                                    $destino = $v['destino']['ciudad'] ?? ($v['destino']['codigo'] ?? '?');
                                    ?>
                                    <strong><?= e($origen) ?></strong>
                                    <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                    <strong><?= e($destino) ?></strong>
                                </td>
                                <td><?= formatDate($v['horaSalida'] ?? null) ?></td>
                                <td><?= formatDate($v['horaLlegada'] ?? null) ?></td>
                                <td><?= number_format((float)($v['distancia'] ?? 0), 0) ?> km</td>
                                <td>
                                    <?php if ($v['activo'] ?? true): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?= url('?page=vuelos&action=show&id=' . $v['id']) ?>"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
