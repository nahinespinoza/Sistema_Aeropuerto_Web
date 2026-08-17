<div class="mb-4">
    <a href="<?= url('?page=aeronaves') ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a aeronaves
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex p-4 mb-3">
                    <i class="bi bi-airplane fs-1 text-success"></i>
                </div>
                <h2 class="h3"><?= e($aeronave['nombre'] ?? '') ?></h2>
                <span class="badge bg-dark fs-6 mb-3"><?= e($aeronave['codigo'] ?? '') ?></span>

                <div class="row text-start mt-4 g-3">
                    <div class="col-6">
                        <div class="text-muted small">Capacidad</div>
                        <div class="fw-semibold">
                            <i class="bi bi-people me-1"></i>
                            <?= (int)($aeronave['capacidad'] ?? 0) ?> pasajeros
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Tipo</div>
                        <div class="fw-semibold"><?= e($aeronave['tipo'] ?? '-') ?></div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">ID interno</div>
                        <div class="fw-semibold">#<?= e($aeronave['id'] ?? '') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
