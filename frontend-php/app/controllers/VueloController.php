<?php
/**
 * Controlador de Vuelos
 */
class VueloController
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Listar / buscar vuelos
     */
    public function index(): void
    {
        $fecha   = $_GET['fecha']   ?? null;
        $origen  = $_GET['origen']  ?? null;
        $destino = $_GET['destino'] ?? null;

        $params = [];
        if ($fecha)   $params['fecha']   = $fecha;
        if ($origen)  $params['origen']  = $origen;
        if ($destino) $params['destino'] = $destino;

        $response = $this->api->get('/api/vuelos', $params);

        view('vuelos/index', [
            'title'   => 'Vuelos',
            'vuelos'  => $response['success'] ? ($response['data'] ?? []) : [],
            'filtros' => [
                'fecha'   => $fecha,
                'origen'  => $origen,
                'destino' => $destino
            ],
            'error'   => $response['success'] ? null : ($response['error'] ?? 'Error al cargar vuelos')
        ]);
    }

    /**
     * Formulario de registro
     */
    public function create(): void
    {
        // Cargar datos para los selects
        $aerolineas  = $this->api->get('/api/aerolineas');
        $aeronaves   = $this->api->get('/api/aeronaves');
        $aeropuertos = $this->api->get('/api/aeropuertos');

        view('vuelos/create', [
            'title'       => 'Registrar Vuelo',
            'aerolineas'  => $aerolineas['success']  ? ($aerolineas['data']  ?? []) : [],
            'aeronaves'   => $aeronaves['success']   ? ($aeronaves['data']   ?? []) : [],
            'aeropuertos' => $aeropuertos['success'] ? ($aeropuertos['data'] ?? []) : [],
        ]);
    }

    /**
     * Guardar nuevo vuelo
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=vuelos'));
        }

        $numeroVuelo = trim($_POST['numeroVuelo'] ?? '');
        $aerolineaId = $_POST['aerolineaId'] ?? null;
        $aeronaveId  = $_POST['aeronaveId']  ?? null;
        $origenId    = $_POST['origenId']    ?? null;
        $destinoId   = $_POST['destinoId']   ?? null;
        $horaSalida  = $_POST['horaSalida']  ?? null;
        $horaLlegada = $_POST['horaLlegada'] ?? null;
        $distancia   = $_POST['distancia']   ?? null;

        if (!$numeroVuelo || !$aerolineaId || !$aeronaveId || !$origenId || !$destinoId || !$horaSalida || !$horaLlegada || !$distancia) {
            setFlash('danger', 'Todos los campos son obligatorios.');
            redirect(url('?page=vuelos&action=create'));
        }

        if ($origenId === $destinoId) {
            setFlash('danger', 'El origen y el destino no pueden ser el mismo aeropuerto.');
            redirect(url('?page=vuelos&action=create'));
        }

        // Convertir datetime-local (YYYY-MM-DDTHH:MM) a ISO completo
        $horaSalida  = str_replace(' ', 'T', $horaSalida);
        $horaLlegada = str_replace(' ', 'T', $horaLlegada);

        if (strlen($horaSalida) === 16)  $horaSalida  .= ':00';
        if (strlen($horaLlegada) === 16) $horaLlegada .= ':00';

        $params = [
            'numeroVuelo' => $numeroVuelo,
            'aerolineaId' => $aerolineaId,
            'aeronaveId'  => $aeronaveId,
            'origenId'    => $origenId,
            'destinoId'   => $destinoId,
            'horaSalida'  => $horaSalida,
            'horaLlegada' => $horaLlegada,
            'distancia'   => $distancia
        ];


        $response = $this->api->postForm('/api/vuelos', $params);

        if ($response['success'] || $response['status'] === 201) {
            setFlash('success', 'Vuelo registrado correctamente.');
            redirect(url('?page=vuelos'));
        }

        setFlash('danger', $response['error'] ?? 'Error al registrar el vuelo.');
        redirect(url('?page=vuelos&action=create'));
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
            'title' => 'Detalle del Vuelo',
            'vuelo' => $response['data']
        ]);
    }

    /**
     * Desactivar vuelo
     */
    public function desactivar(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=vuelos'));
        }

        $response = $this->api->put("/api/vuelos/{$id}/desactivar", []);

        if ($response['success'] || $response['status'] === 204) {
            setFlash('success', 'Vuelo desactivado correctamente.');
        } else {
            setFlash('danger', $response['error'] ?? 'Error al desactivar el vuelo.');
        }

        redirect(url('?page=vuelos'));
    }

    /**
 * Devuelve la flota de una aerolínea (para el select del formulario)
 */
public function flota(): void
{
    header('Content-Type: application/json');

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode([]);
        exit;
    }

    $response = $this->api->get("/api/aerolineas/{$id}/flota");

    if ($response['success'] && is_array($response['data'])) {
        echo json_encode($response['data']);
    } else {
        echo json_encode([]);
    }
    exit;
}

}