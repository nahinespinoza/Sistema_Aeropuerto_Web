<div class="mb-4">
    <a href="<?= url('?page=aerolineas&action=show&id=' . $aerolinea['id']) ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a <?= e($aerolinea['nombre'] ?? 'aerolínea') ?>
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">
                    <i class="bi bi-airplane me-2 text-success"></i>Agregar Aeronave
                </h4>
                <small class="text-muted">
                    A: <strong><?= e($aerolinea['nombre'] ?? '') ?></strong>
                    (<?= e($aerolinea['codigo'] ?? '') ?>)
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= url('?page=aerolineas&action=storeAeronave') ?>">
                    <input type="hidden" name="aerolinea_id" value="<?= e($aerolinea['id']) ?>">

                    <div class="mb-3">
                        <label class="form-label">Código del modelo <span class="text-danger">*</span></label>
                        <input type="text" name="codigo" class="form-control" required
                               maxlength="20" placeholder="Ej: A320, B738, B787">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre / Descripción <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" required
                               maxlength="100" placeholder="Ej: Airbus A320">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Capacidad (pasajeros) <span class="text-danger">*</span></label>
                            <input type="number" name="capacidad" class="form-control" required
                                   min="1" placeholder="180">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipo <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-select" required>
                                <option value="Comercial">Comercial</option>
                                <option value="Carga">Carga</option>
                                <option value="Privado">Privado</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= url('?page=aerolineas&action=show&id=' . $aerolinea['id']) ?>"
                           class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg me-1"></i>Agregar aeronave
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
