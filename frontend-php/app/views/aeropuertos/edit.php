<div class="mb-4">
    <a href="<?= url('?page=aeropuertos&action=show&id=' . $aeropuerto['id']) ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver al detalle
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">
                    <i class="bi bi-pencil me-2 text-warning"></i>Editar Aeropuerto
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= url('?page=aeropuertos&action=update') ?>">
                    <input type="hidden" name="id" value="<?= e($aeropuerto['id']) ?>">

                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control"
                               value="<?= e($aeropuerto['codigo'] ?? '') ?>" disabled>
                        <div class="form-text">El código no se puede modificar.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" required
                               maxlength="100" value="<?= e($aeropuerto['nombre'] ?? '') ?>">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Ciudad <span class="text-danger">*</span></label>
                            <input type="text" name="ciudad" class="form-control" required
                                   maxlength="50" value="<?= e($aeropuerto['ciudad'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">País <span class="text-danger">*</span></label>
                            <input type="text" name="pais" class="form-control" required
                                   maxlength="50" value="<?= e($aeropuerto['pais'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= url('?page=aeropuertos&action=show&id=' . $aeropuerto['id']) ?>"
                           class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning text-dark">
                            <i class="bi bi-check-lg me-1"></i>Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
