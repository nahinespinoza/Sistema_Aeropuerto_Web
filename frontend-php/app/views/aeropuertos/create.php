<div class="mb-4">
    <a href="<?= url('?page=aeropuertos') ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a aeropuertos
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">
                    <i class="bi bi-geo-alt me-2 text-warning"></i>Registrar Aeropuerto
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= url('?page=aeropuertos&action=store') ?>">

                    <div class="mb-3">
                        <label class="form-label">Código IATA / interno <span class="text-danger">*</span></label>
                        <input type="text" name="codigo" class="form-control text-uppercase"
                               maxlength="10" required placeholder="Ej: GYE, UIO, BOG">
                        <div class="form-text">Máximo 10 caracteres. Se guardará en mayúsculas.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre del aeropuerto <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control"
                               maxlength="100" required
                               placeholder="Ej: José Joaquín de Olmedo">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Ciudad <span class="text-danger">*</span></label>
                            <input type="text" name="ciudad" class="form-control"
                                   maxlength="50" required placeholder="Ej: Guayaquil">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">País <span class="text-danger">*</span></label>
                            <input type="text" name="pais" class="form-control"
                                   maxlength="50" required placeholder="Ej: Ecuador">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= url('?page=aeropuertos') ?>" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning text-dark">
                            <i class="bi bi-check-lg me-1"></i>Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
