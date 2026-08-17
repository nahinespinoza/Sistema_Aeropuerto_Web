/**
 * JavaScript del frontend - Sistema Aeroportuario
 */

document.addEventListener('DOMContentLoaded', function () {

    // ==================== Flota dinámica (formulario de registro) ====================
    const btnAgregar = document.getElementById('btnAgregarAvion');
    const container  = document.getElementById('flotaContainer');
    const template   = document.getElementById('avionTemplate');

    if (btnAgregar && container && template) {
        // Agregar una fila al inicio
        agregarAvion();

        btnAgregar.addEventListener('click', function () {
            agregarAvion();
        });

        // Delegación para botones de eliminar
        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove-avion') ||
                e.target.closest('.btn-remove-avion')) {
                const row = e.target.closest('.avion-row');
                if (row) {
                    row.remove();
                }
            }
        });
    }

    function agregarAvion() {
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
    }

    // ==================== Auto-cerrar alerts después de 5 segundos ====================
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) bsAlert.close();
        }, 5000);
    });

    // ==================== Confirmar eliminaciones (extra) ====================
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (!confirm(el.dataset.confirm || '¿Estás seguro?')) {
                e.preventDefault();
            }
        });
    });
});
