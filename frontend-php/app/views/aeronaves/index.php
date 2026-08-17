<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="bi bi-airplane me-2 text-success"></i>Aeronaves</h1>
        <p class="text-muted mb-0">Listado general de la flota</p>
    </div>
    <a href="<?= url('?page=aeronaves&action=create') ?>" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i>Nueva Aeronave
    </a>
</div>

<!-- Filtro por tipo -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <input type="hidden" name="page" value="aeronaves">
            <div class="col-md-6">
                <label class="form-label">Filtrar por tipo</label>
                <select name="tipo" class="form-select">
                    <option value="">Todos los tipos</option>
                    <option value="Comercial" <?= ($filtro ?? '') === 'Comercial' ? 'selected' : '' ?>>Comercial</option>
                    <option value="Carga" <?= ($filtro ?? '') === 'Carga' ? 'selected' : '' ?>>Carga</option>
                    <option value="Privado" <?= ($filtro ?? '') === 'Privado' ? 'selected' : '' ?>>Privado</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-outline-success me-2">
                    <i class="bi bi-search me-1"></i>Filtrar
                </button>
                <?php if (!empty($filtro)): ?>
                    <a href="<?= url('?page=aeronaves') ?>" class="btn btn-outline-secondary">Limpiar</a>
                <?php endif; ?>
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
        <?php if (empty($aeronaves)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-airplane fs-1 d-block mb-2"></i>
                No se encontraron aeronaves.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Capacidad</th>
                            <th>Tipo</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aeronaves as $a): ?>
                            <tr>
                                <td><span class="badge bg-dark"><?= e($a['codigo'] ?? '') ?></span></td>
                                <td class="fw-semibold"><?= e($a['nombre'] ?? '') ?></td>
                                <td>
                                    <i class="bi bi-people me-1 text-muted"></i>
                                    <?= (int)($a['capacidad'] ?? 0) ?>
                                </td>
                                <td>
                                    <?php
                                    $tipo = $a['tipo'] ?? 'Comercial';
                                    $badgeClass = match($tipo) {
                                        'Carga'   => 'bg-warning text-dark',
                                        'Privado' => 'bg-info',
                                        default   => 'bg-success'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= e($tipo) ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="<?= url('?page=aeronaves&action=show&id=' . $a['id']) ?>"
                                       class="btn btn-sm btn-outline-primary">
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
