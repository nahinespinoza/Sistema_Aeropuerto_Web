<div class="mb-4">
    <a href="<?= url('?page=aerolineas') ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a aerolíneas
    </a>
</div>

<!-- Datos de la aerolínea -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <span class="badge bg-primary fs-5 mb-2"><?= e($aerolinea['codigo'] ?? '') ?></span>
                <h2 class="h3 mb-1"><?= e($aerolinea['nombre'] ?? '') ?></h2>
                <p class="text-muted mb-0">
                    <i class="bi bi-geo-alt me-1"></i><?= e($aerolinea['pais'] ?? 'Sin país') ?>
                </p>
            </div>
            <div class="btn-group">
                <a href="<?= url('?page=aerolineas&action=edit&id=' . $aerolinea['id']) ?>"
                   class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-pencil me-1"></i>Editar
                </a>
                <a href="<?= url('?page=aerolineas&action=delete&id=' . $aerolinea['id']) ?>"
                   class="btn btn-outline-danger btn-sm"
                   onclick="return confirm('¿Eliminar esta aerolínea y toda su flota?')">
                    <i class="bi bi-trash me-1"></i>Eliminar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Flota -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">
        <i class="bi bi-airplane me-2"></i>Flota
        <span class="badge bg-secondary"><?= count($flota) ?></span>
    </h4>
    <a href="<?= url('?page=aerolineas&action=addAeronave&id=' . $aerolinea['id']) ?>"
       class="btn btn-success btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Agregar aeronave
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($flota)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-airplane fs-1 d-block mb-2"></i>
                Esta aerolínea aún no tiene aeronaves registradas.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre / Modelo</th>
                            <th>Capacidad</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($flota as $avion): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-dark"><?= e($avion['codigo'] ?? '') ?></span>
                                </td>
                                <td class="fw-semibold"><?= e($avion['nombre'] ?? '') ?></td>
                                <td>
                                    <i class="bi bi-people me-1 text-muted"></i>
                                    <?= (int)($avion['capacidad'] ?? 0) ?> pasajeros
                                </td>
                                <td>
                                    <?php
                                    $tipo = $avion['tipo'] ?? 'Comercial';
                                    $badgeClass = match($tipo) {
                                        'Carga'   => 'bg-warning text-dark',
                                        'Privado' => 'bg-info',
                                        default   => 'bg-success'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= e($tipo) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
