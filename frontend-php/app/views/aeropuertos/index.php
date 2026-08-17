<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="bi bi-geo-alt me-2 text-warning"></i>Aeropuertos</h1>
        <p class="text-muted mb-0">Registro y consulta de infraestructura aeroportuaria</p>
    </div>
    <a href="<?= url('?page=aeropuertos&action=create') ?>" class="btn btn-warning text-dark">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Aeropuerto
    </a>
</div>

<!-- Filtros -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <input type="hidden" name="page" value="aeropuertos">
            <div class="col-md-4">
                <label class="form-label">Ciudad</label>
                <input type="text" name="ciudad" class="form-control"
                       value="<?= e($filtros['ciudad'] ?? '') ?>"
                       placeholder="Ej: Guayaquil">
            </div>
            <div class="col-md-4">
                <label class="form-label">País</label>
                <input type="text" name="pais" class="form-control"
                       value="<?= e($filtros['pais'] ?? '') ?>"
                       placeholder="Ej: Ecuador">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-outline-warning me-2">
                    <i class="bi bi-search me-1"></i>Buscar
                </button>
                <?php if (!empty($filtros['ciudad']) || !empty($filtros['pais'])): ?>
                    <a href="<?= url('?page=aeropuertos') ?>" class="btn btn-outline-secondary">Limpiar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i><?= e($error) ?>
        <br><small>Asegúrate de haber agregado <code>AeropuertoController</code> y <code>AeropuertoService</code> en el backend y de reiniciarlo.</small>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($aeropuertos)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-geo-alt fs-1 d-block mb-2"></i>
                No se encontraron aeropuertos.
                <br>
                <a href="<?= url('?page=aeropuertos&action=create') ?>" class="btn btn-sm btn-warning text-dark mt-3">
                    Registrar el primero
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Ciudad</th>
                            <th>País</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aeropuertos as $a): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-warning text-dark fs-6"><?= e($a['codigo'] ?? '') ?></span>
                                </td>
                                <td class="fw-semibold"><?= e($a['nombre'] ?? '') ?></td>
                                <td><?= e($a['ciudad'] ?? '-') ?></td>
                                <td><?= e($a['pais'] ?? '-') ?></td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= url('?page=aeropuertos&action=show&id=' . $a['id']) ?>"
                                           class="btn btn-outline-primary" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= url('?page=aeropuertos&action=edit&id=' . $a['id']) ?>"
                                           class="btn btn-outline-secondary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= url('?page=aeropuertos&action=delete&id=' . $a['id']) ?>"
                                           class="btn btn-outline-danger"
                                           onclick="return confirm('¿Eliminar este aeropuerto?')"
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
