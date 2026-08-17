<div class="mb-4">
    <a href="<?= url('?page=aeropuertos') ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a aeropuertos
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div class="rounded-circle bg-warning bg-opacity-25 d-inline-flex p-4 mb-3">
                    <i class="bi bi-geo-alt fs-1 text-warning"></i>
                </div>
                <span class="badge bg-warning text-dark fs-5 mb-2"><?= e($aeropuerto['codigo'] ?? '') ?></span>
                <h2 class="h3"><?= e($aeropuerto['nombre'] ?? '') ?></h2>

                <div class="row text-start mt-4 g-3">
                    <div class="col-6">
                        <div class="text-muted small">Ciudad</div>
                        <div class="fw-semibold">
                            <i class="bi bi-building me-1"></i><?= e($aeropuerto['ciudad'] ?? '-') ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">País</div>
                        <div class="fw-semibold">
                            <i class="bi bi-flag me-1"></i><?= e($aeropuerto['pais'] ?? '-') ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">ID interno</div>
                        <div class="fw-semibold">#<?= e($aeropuerto['id'] ?? '') ?></div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <a href="<?= url('?page=aeropuertos&action=edit&id=' . $aeropuerto['id']) ?>"
                       class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-pencil me-1"></i>Editar
                    </a>
                    <a href="<?= url('?page=aeropuertos&action=delete&id=' . $aeropuerto['id']) ?>"
                       class="btn btn-outline-danger btn-sm"
                       onclick="return confirm('¿Eliminar este aeropuerto?')">
                        <i class="bi bi-trash me-1"></i>Eliminar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
