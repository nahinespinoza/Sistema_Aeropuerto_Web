<div class="row mb-4">
    <div class="col">
        <h1 class="h3 mb-1">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Panel de Control
        </h1>
        <p class="text-muted">Sistema Web Distribuido de Gestión Aeroportuaria</p>
    </div>
</div>

<!-- Estadísticas -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                    <i class="bi bi-building fs-3 text-primary"></i>
                </div>
                <div>
                    <div class="text-muted small">Aerolíneas</div>
                    <div class="fs-3 fw-bold"><?= (int)$stats['aerolineas'] ?></div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="<?= url('?page=aerolineas') ?>" class="btn btn-sm btn-outline-primary w-100">
                    Ver aerolíneas
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <i class="bi bi-airplane fs-3 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small">Aeronaves</div>
                    <div class="fs-3 fw-bold"><?= (int)$stats['aeronaves'] ?></div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="<?= url('?page=aeronaves') ?>" class="btn btn-sm btn-outline-success w-100">
                    Ver aeronaves
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                    <i class="bi bi-calendar-check fs-3 text-info"></i>
                </div>
                <div>
                    <div class="text-muted small">Vuelos</div>
                    <div class="fs-3 fw-bold"><?= (int)$stats['vuelos'] ?></div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="<?= url('?page=vuelos') ?>" class="btn btn-sm btn-outline-info w-100">
                    Ver vuelos
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Accesos rápidos -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Acciones rápidas</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= url('?page=aerolineas&action=create') ?>" class="btn btn-primary">
                        <i class="bi bi-building-add me-2"></i>Registrar nueva aerolínea
                    </a>
                    <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-search me-2"></i>Buscar vuelos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información del sistema</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-server text-primary me-2"></i>
                        Backend: <strong>Java Spring Boot</strong> (puerto 8080)
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-code-slash text-success me-2"></i>
                        Frontend: <strong>PHP + Bootstrap 5</strong>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-database text-warning me-2"></i>
                        Base de datos: <strong>H2 (en memoria)</strong>
                    </li>
                    <li>
                        <i class="bi bi-people text-info me-2"></i>
                        Equipo: <strong>Nahin Espinoza &amp; Julian Rojas</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
