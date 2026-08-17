<div class="mb-4">
    <a href="<?= url('?page=aerolineas') ?>" class="text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Volver a aerolíneas
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">
                    <i class="bi bi-building-add me-2 text-primary"></i>Registrar Aerolínea
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= url('?page=aerolineas&action=store') ?>" id="formAerolinea">

                    <!-- Datos de la aerolínea -->
                    <h5 class="mb-3 text-primary">Datos de la aerolínea</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Código <span class="text-danger">*</span></label>
                            <input type="text" name="codigo" class="form-control text-uppercase"
                                   maxlength="10" required placeholder="Ej: AV"
                                   value="<?= e($_POST['codigo'] ?? '') ?>">
                            <div class="form-text">Código IATA o interno (máx. 10 caracteres)</div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control"
                                   maxlength="100" required placeholder="Ej: Avianca"
                                   value="<?= e($_POST['nombre'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">País</label>
                            <input type="text" name="pais" class="form-control"
                                   maxlength="50" placeholder="Ej: Colombia"
                                   value="<?= e($_POST['pais'] ?? '') ?>">
                        </div>
                    </div>

                    <hr>

                    <!-- Flota inicial (opcional) -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-primary">
                            Flota inicial <small class="text-muted fw-normal">(opcional)</small>
                        </h5>
                        <button type="button" class="btn btn-sm btn-outline-success" id="btnAgregarAvion">
                            <i class="bi bi-plus-lg me-1"></i>Agregar avión
                        </button>
                    </div>

                    <div id="flotaContainer">
                        <!-- Las filas de aviones se agregan dinámicamente con JS -->
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="<?= url('?page=aerolineas') ?>" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Registrar Aerolínea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Template de fila de avión (oculto) -->
<template id="avionTemplate">
    <div class="avion-row border rounded p-3 mb-3 bg-light position-relative">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 btn-remove-avion"
                title="Quitar avión"></button>
        <div class="row g-2">
            <div class="col-md-3">
                <label class="form-label small">Código</label>
                <input type="text" name="avion_codigo[]" class="form-control form-control-sm"
                       placeholder="A320" maxlength="20">
            </div>
            <div class="col-md-4">
                <label class="form-label small">Nombre</label>
                <input type="text" name="avion_nombre[]" class="form-control form-control-sm"
                       placeholder="Airbus A320" maxlength="100">
            </div>
            <div class="col-md-2">
                <label class="form-label small">Capacidad</label>
                <input type="number" name="avion_capacidad[]" class="form-control form-control-sm"
                       placeholder="180" min="1">
            </div>
            <div class="col-md-3">
                <label class="form-label small">Tipo</label>
                <select name="avion_tipo[]" class="form-select form-select-sm">
                    <option value="Comercial">Comercial</option>
                    <option value="Carga">Carga</option>
                    <option value="Privado">Privado</option>
                </select>
            </div>
        </div>
    </div>
</template>
