<?php
$v = $vuelo ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">
        <i class="bi bi-airplane me-2"></i>
        Vuelo <?= e($v['numeroVuelo'] ?? '') ?>
    </h2>
    <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Información del vuelo</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Número</dt>
                    <dd class="col-sm-8"><strong><?= e($v['numeroVuelo'] ?? '-') ?></strong></dd>

                    <dt class="col-sm-4">Aerolínea</dt>
                    <dd class="col-sm-8">
                        <?= e($v['aerolinea']['nombre'] ?? '-') ?>
                        (<?= e($v['aerolinea']['codigo'] ?? '') ?>)
                    </dd>

                    <dt class="col-sm-4">Aeronave</dt>
                    <dd class="col-sm-8">
                        <?= e($v['aeronave']['nombre'] ?? $v['aeronave']['codigo'] ?? '-') ?>
                        — Capacidad: <?= e($v['aeronave']['capacidad'] ?? '?') ?>
                    </dd>

                    <dt class="col-sm-4">Origen</dt>
                    <dd class="col-sm-8">
                        <?= e($v['origen']['nombre'] ?? '') ?>
                        (<?= e($v['origen']['codigo'] ?? '') ?>) —
                        <?= e($v['origen']['ciudad'] ?? '') ?>, <?= e($v['origen']['pais'] ?? '') ?>
                    </dd>

                    <dt class="col-sm-4">Destino</dt>
                    <dd class="col-sm-8">
                        <?= e($v['destino']['nombre'] ?? '') ?>
                        (<?= e($v['destino']['codigo'] ?? '') ?>) —
                        <?= e($v['destino']['ciudad'] ?? '') ?>, <?= e($v['destino']['pais'] ?? '') ?>
                    </dd>

                    <dt class="col-sm-4">Salida</dt>
                    <dd class="col-sm-8">
                        <?= isset($v['horaSalida']) ? date('d/m/Y H:i', strtotime($v['horaSalida'])) : '-' ?>
                    </dd>

                    <dt class="col-sm-4">Llegada</dt>
                    <dd class="col-sm-8">
                        <?= isset($v['horaLlegada']) ? date('d/m/Y H:i', strtotime($v['horaLlegada'])) : '-' ?>
                    </dd>

                    <dt class="col-sm-4">Distancia</dt>
                    <dd class="col-sm-8"><?= e($v['distancia'] ?? '-') ?> km</dd>

                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8">
                        <?php if (!empty($v['activo'])): ?>
                            <span class="badge bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactivo</span>
                        <?php endif; ?>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Acciones</div>
            <div class="card-body d-grid gap-2">
                <?php if (!empty($v['activo'])): ?>
                    <a href="<?= url('?page=vuelos&action=desactivar&id=' . ($v['id'] ?? '')) ?>"
                       class="btn btn-outline-danger"
                       onclick="return confirm('¿Desactivar este vuelo?')">
                        <i class="bi bi-x-circle me-1"></i> Desactivar vuelo
                    </a>
                <?php endif; ?>
                <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>