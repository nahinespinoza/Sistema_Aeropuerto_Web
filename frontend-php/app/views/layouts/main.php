<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Sistema Aeroportuario') ?> | <?= APP_NAME ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- CSS propio -->
    <link href="<?= url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= url() ?>">
                <i class="bi bi-airplane-engines me-2"></i><?= APP_NAME ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($title ?? '') === 'Inicio' ? 'active' : '' ?>" href="<?= url() ?>">
                            <i class="bi bi-house me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains($title ?? '', 'Aerolínea') ? 'active' : '' ?>" href="<?= url('?page=aerolineas') ?>">
                            <i class="bi bi-building me-1"></i>Aerolíneas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains($title ?? '', 'Aeronave') ? 'active' : '' ?>" href="<?= url('?page=aeronaves') ?>">
                            <i class="bi bi-airplane me-1"></i>Aeronaves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains($title ?? '', 'Aeropuerto') ? 'active' : '' ?>" href="<?= url('?page=aeropuertos') ?>">
                            <i class="bi bi-geo-alt me-1"></i>Aeropuertos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains($title ?? '', 'Vuelo') ? 'active' : '' ?>" href="<?= url('?page=vuelos') ?>">
                            <i class="bi bi-calendar-check me-1"></i>Vuelos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container py-4">

        <!-- Flash messages -->
        <?php $flash = getFlash(); if ($flash): ?>
            <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
                <?= e($flash['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container text-center text-muted small">
            <span><?= APP_NAME ?> v<?= APP_VERSION ?></span> ·
            <span>Nahin Espinoza &amp; Julian Rojas</span> ·
            <span>Proyecto Lenguajes de Programación</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS propio -->
    <script src="<?= url('assets/js/app.js') ?>"></script>
</body>
</html>
