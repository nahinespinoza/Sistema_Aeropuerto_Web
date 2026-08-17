<div class="mb-4">
    <a href="<?= url('?page=vuelos') ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a vuelos
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-airplane-engines me-2 text-info"></i>
                    Vuelo <?= e($vuelo['numeroVuelo'] ?? '') ?>
                </h4>
                <?php if ($vuelo['activo'] ?? true): ?>
                    <span class="badge bg-success">Activo</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Inactivo</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Ruta -->
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">Origen</div>
                        <div class="fs-5 fw-semibold">
                            <?= e($vuelo['origen']['nombre'] ?? '') ?>
                            <span class="badge bg-primary"><?= e($vuelo['origen']['codigo'] ?? '') ?></span>
                        </div>
                        <div class="text-muted">
                            <?= e($vuelo['origen']['ciudad'] ?? '') ?>, <?= e($vuelo['origen']['pais'] ?? '') ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">Destino</div>
                        <div class="fs-5 fw-semibold">
                            <?= e($vuelo['destino']['nombre'] ?? '') ?>
                            <span class="badge bg-primary"><?= e($vuelo['destino']['codigo'] ?? '') ?></span>
                        </div>
                        <div class="text-muted">
                            <?= e($vuelo['destino']['ciudad'] ?? '') ?>, <?= e($vuelo['destino']['pais'] ?? '') ?>
                        </div>
                    </div>

                    <div class="col-12"><hr></div>

                    <!-- Horarios -->
                    <div class="col-md-4">
                        <div class="text-muted small">Salida</div>
                        <div class="fw-semibold"><?= formatDate($vuelo['horaSalida'] ?? null) ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Llegada</div>
                        <div class="fw-semibold"><?= formatDate($vuelo['horaLlegada'] ?? null) ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Distancia</div>
                        <div class="fw-semibold"><?= number_format((float)($vuelo['distancia'] ?? 0), 0) ?> km</div>
                    </div>

                    <div class="col-12"><hr></div>

                    <!-- Aerolínea y aeronave -->
                    <div class="col-md-6">
                        <div class="text-muted small">Aerolínea</div>
                        <div class="fw-semibold">
                            <?= e($vuelo['aerolinea']['nombre'] ?? '-') ?>
                            <?php if (!empty($vuelo['aerolinea']['codigo'])): ?>
                                <span class="badge bg-secondary"><?= e($vuelo['aerolinea']['codigo']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Aeronave</div>
                        <div class="fw-semibold">
                            <?= e($vuelo['aeronave']['nombre'] ?? '-') ?>
                            <?php if (!empty($vuelo['aeronave']['codigo'])): ?>
                                <span class="badge bg-dark"><?= e($vuelo['aeronave']['codigo']) ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($vuelo['aeronave']['capacidad'])): ?>
                            <div class="text-muted small">
                                Capacidad: <?= (int)$vuelo['aeronave']['capacidad'] ?> pasajeros
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
