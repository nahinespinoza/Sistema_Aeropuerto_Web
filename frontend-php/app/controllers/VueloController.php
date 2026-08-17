<?php
/**
 * Controlador de Vuelos (parte de Julian, pero incluido para integración)
 */
class VueloController
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Buscar / listar vuelos
     */
    public function index(): void
    {
        $fecha   = $_GET['fecha'] ?? null;
        $origen  = $_GET['origen'] ?? null;
        $destino = $_GET['destino'] ?? null;

        $params = [];
        if ($fecha)   $params['fecha']   = $fecha;
        if ($origen)  $params['origen']  = $origen;
        if ($destino) $params['destino'] = $destino;

        $response = $this->api->get('/api/vuelos', $params);

        view('vuelos/index', [
            'title'  => 'Vuelos',
            'vuelos' => $response['success'] ? ($response['data'] ?? []) : [],
            'filtros'=> [
                'fecha'   => $fecha,
                'origen'  => $origen,
                'destino' => $destino
            ],
            'error'  => $response['success'] ? null : ($response['error'] ?? 'Error al cargar vuelos')
        ]);
    }

    /**
     * Ver detalle de un vuelo
     */
    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=vuelos'));
        }

        $response = $this->api->get("/api/vuelos/{$id}");

        if (!$response['success']) {
            setFlash('danger', 'Vuelo no encontrado.');
            redirect(url('?page=vuelos'));
        }

        view('vuelos/show', [
            'title' => 'Detalle de Vuelo',
            'vuelo' => $response['data']
        ]);
    }
}
