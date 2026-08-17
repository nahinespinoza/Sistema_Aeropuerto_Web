<?php
/**
 * Controlador de la página de inicio
 */
class HomeController
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index(): void
    {
        // Obtener estadísticas básicas
        $aerolineas = $this->api->get('/api/aerolineas');
        $aeronaves  = $this->api->get('/api/aeronaves');
        $vuelos     = $this->api->get('/api/vuelos');

        $stats = [
            'aerolineas' => $aerolineas['success'] ? count($aerolineas['data'] ?? []) : 0,
            'aeronaves'  => $aeronaves['success']  ? count($aeronaves['data'] ?? [])  : 0,
            'vuelos'     => $vuelos['success']     ? count($vuelos['data'] ?? [])     : 0,
        ];

        view('home/index', [
            'title' => 'Inicio',
            'stats' => $stats
        ]);
    }
}
