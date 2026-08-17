<?php
$aerolineas  = $aerolineas  ?? [];
$aeronaves   = $aeronaves   ?? [];
$aeropuertos = $aeropuertos ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Registrar Vuelo</h2>
    <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= url('?page=vuelos&action=store') ?>">

            <div class="row g-3">
                <!-- Número de vuelo -->
                <div class="col-md-4">
                    <label class="form-label">Número de vuelo *</label>
                    <input type="text" name="numeroVuelo" class="form-control"
                           placeholder="Ej: AV1234" required>
                </div>

                <!-- Aerolínea -->
                <div class="col-md-4">
                    <label class="form-label">Aerolínea *</label>
                    <select name="aerolineaId" id="aerolineaId" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($aerolineas as $a): ?>
                            <option value="<?= e($a['id']) ?>">
                                <?= e($a['codigo'] . ' - ' . $a['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Aeronave -->
                <div class="col-md-4">
                        <label class="form-label">Aeronave *</label>
                        <select name="aeronaveId" id="aeronaveId" class="form-select" required>
                     <option value="">Primero seleccione una aerolínea...</option>
                    </select>
                </div>

                <!-- Origen -->
                <div class="col-md-6">
                    <label class="form-label">Aeropuerto origen *</label>
                    <select name="origenId" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($aeropuertos as $ap): ?>
                            <option value="<?= e($ap['id']) ?>">
                                <?= e($ap['codigo'] . ' - ' . $ap['nombre'] . ' (' . $ap['ciudad'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Destino -->
                <div class="col-md-6">
                    <label class="form-label">Aeropuerto destino *</label>
                    <select name="destinoId" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($aeropuertos as $ap): ?>
                            <option value="<?= e($ap['id']) ?>">
                                <?= e($ap['codigo'] . ' - ' . $ap['nombre'] . ' (' . $ap['ciudad'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Hora salida -->
                <div class="col-md-4">
                    <label class="form-label">Hora de salida *</label>
                    <input type="datetime-local" name="horaSalida" class="form-control" required>
                </div>

                <!-- Hora llegada -->
                <div class="col-md-4">
                    <label class="form-label">Hora de llegada *</label>
                    <input type="datetime-local" name="horaLlegada" class="form-control" required>
                </div>

                <!-- Distancia -->
                <div class="col-md-4">
                    <label class="form-label">Distancia (km) *</label>
                    <input type="number" name="distancia" class="form-control"
                           step="0.1" min="1" placeholder="Ej: 850" required>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Guardar Vuelo
                </button>
                <a href="<?= url('?page=vuelos') ?>" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('aerolineaId')?.addEventListener('change', async function () {
    const aerolineaId = this.value;
    const selectAv = document.getElementById('aeronaveId');
    if (!selectAv) return;

    selectAv.innerHTML = '<option value="">Cargando...</option>';

    if (!aerolineaId) {
        selectAv.innerHTML = '<option value="">Primero seleccione una aerolínea...</option>';
        return;
    }

    try {
        const res = await fetch('?page=vuelos&action=flota&id=' + aerolineaId);
        const flota = await res.json();

        selectAv.innerHTML = '<option value="">Seleccione...</option>';

        if (!Array.isArray(flota) || flota.length === 0) {
            selectAv.innerHTML = '<option value="">Esta aerolínea no tiene aeronaves</option>';
            return;
        }

        flota.forEach(av => {
            const opt = document.createElement('option');
            opt.value = av.id;
            opt.textContent = (av.codigo || '') + ' - ' + (av.nombre || '') +
                              ' (cap: ' + (av.capacidad || '?') + ')';
            selectAv.appendChild(opt);
        });
    } catch (e) {
        selectAv.innerHTML = '<option value="">Error al cargar aeronaves</option>';
        console.error(e);
    }
});
</script>