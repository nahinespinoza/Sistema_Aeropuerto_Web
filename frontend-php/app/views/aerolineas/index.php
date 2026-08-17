<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="bi bi-building me-2 text-primary"></i>Aerolíneas</h1>
        <p class="text-muted mb-0">Gestión de aerolíneas y su flota</p>
    </div>
    <a href="<?= url('?page=aerolineas&action=create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nueva Aerolínea
    </a>
</div>

<!-- Filtro -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <input type="hidden" name="page" value="aerolineas">
            <div class="col-md-8">
                <label class="form-label">Buscar por nombre</label>
                <input type="text" name="nombre" class="form-control"
                       value="<?= e($filtro ?? '') ?>"
                       placeholder="Ej: Avianca, Iberia...">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-outline-primary me-2">
                    <i class="bi bi-search me-1"></i>Buscar
                </button>
                <?php if (!empty($filtro)): ?>
                    <a href="<?= url('?page=aerolineas') ?>" class="btn btn-outline-secondary">
                        Limpiar
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i><?= e($error) ?>
        <br><small>Verifica que el backend esté corriendo en <code>http://localhost:8080</code></small>
    </div>
<?php endif; ?>

<!-- Tabla -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($aerolineas)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                No se encontraron aerolíneas.
                <br>
                <a href="<?= url('?page=aerolineas&action=create') ?>" class="btn btn-sm btn-primary mt-3">
                    Registrar la primera
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>País</th>
                            <th class="text-center">Flota</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aerolineas as $a): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-primary fs-6"><?= e($a['codigo'] ?? '') ?></span>
                                </td>
                                <td class="fw-semibold"><?= e($a['nombre'] ?? '') ?></td>
                                <td><?= e($a['pais'] ?? '-') ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">
                                        <?= count($a['flota'] ?? []) ?> aviones
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= url('?page=aerolineas&action=show&id=' . $a['id']) ?>"
                                           class="btn btn-outline-primary" title="Ver detalle">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= url('?page=aerolineas&action=edit&id=' . $a['id']) ?>"
                                           class="btn btn-outline-secondary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= url('?page=aerolineas&action=delete&id=' . $a['id']) ?>"
                                           class="btn btn-outline-danger"
                                           onclick="return confirm('¿Eliminar esta aerolínea y su flota?')"
                                           title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
