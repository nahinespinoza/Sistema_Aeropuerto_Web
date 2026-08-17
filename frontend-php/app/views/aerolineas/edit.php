<div class="mb-4">
    <a href="<?= url('?page=aerolineas&action=show&id=' . $aerolinea['id']) ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver al detalle
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">
                    <i class="bi bi-pencil me-2 text-primary"></i>Editar Aerolínea
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= url('?page=aerolineas&action=update') ?>">
                    <input type="hidden" name="id" value="<?= e($aerolinea['id']) ?>">

                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control" value="<?= e($aerolinea['codigo'] ?? '') ?>"
                               disabled>
                        <div class="form-text">El código no se puede modificar.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" required
                               maxlength="100" value="<?= e($aerolinea['nombre'] ?? '') ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">País</label>
                        <input type="text" name="pais" class="form-control"
                               maxlength="50" value="<?= e($aerolinea['pais'] ?? '') ?>">
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= url('?page=aerolineas&action=show&id=' . $aerolinea['id']) ?>"
                           class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
