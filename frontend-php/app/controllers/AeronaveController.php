<?php
/**
 * Controlador de Aeronaves
 */
class AeronaveController
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Listar todas las aeronaves (filtro opcional por tipo)
     */
    public function index(): void
    {
        $tipo = $_GET['tipo'] ?? null;
        $params = $tipo ? ['tipo' => $tipo] : [];

        $response = $this->api->get('/api/aeronaves', $params);

        view('aeronaves/index', [
            'title'     => 'Aeronaves',
            'aeronaves' => $response['success'] ? ($response['data'] ?? []) : [],
            'filtro'    => $tipo,
            'error'     => $response['success'] ? null : ($response['error'] ?? 'Error al cargar aeronaves')
        ]);
    }

    /**
     * Formulario para registrar una aeronave (asociada a una aerolínea existente)
     */
    public function create(): void
    {
        $aerolineas = $this->api->get('/api/aerolineas');

        view('aeronaves/create', [
            'title'      => 'Registrar Aeronave',
            'aerolineas' => $aerolineas['success'] ? ($aerolineas['data'] ?? []) : [],
            'errorApi'   => $aerolineas['success'] ? null : ($aerolineas['error'] ?? 'No se pudieron cargar las aerolíneas')
        ]);
    }

    /**
     * Guardar nueva aeronave en una aerolínea existente
     * Usa: POST /api/aerolineas/{id}/aeronaves
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=aeronaves'));
        }

        $aerolineaId = $_POST['aerolinea_id'] ?? null;
        $codigo      = trim($_POST['codigo'] ?? '');
        $nombre      = trim($_POST['nombre'] ?? '');
        $capacidad   = (int) ($_POST['capacidad'] ?? 0);
        $tipo        = trim($_POST['tipo'] ?? 'Comercial');

        if (!$aerolineaId || $codigo === '' || $nombre === '' || $capacidad < 1) {
            setFlash('danger', 'Completa todos los campos obligatorios (aerolínea, código, nombre y capacidad).');
            redirect(url('?page=aeronaves&action=create'));
        }

        $body = [
            'codigo'    => $codigo,
            'nombre'    => $nombre,
            'capacidad' => $capacidad,
            'tipo'      => $tipo
        ];

        $response = $this->api->post("/api/aerolineas/{$aerolineaId}/aeronaves", $body);

        if ($response['success']) {
            setFlash('success', 'Aeronave registrada correctamente.');
            redirect(url('?page=aeronaves'));
        }

        setFlash('danger', $response['error'] ?? 'Error al registrar la aeronave.');
        redirect(url('?page=aeronaves&action=create'));
    }

    /**
     * Ver detalle de una aeronave
     */
    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aeronaves'));
        }

        $response = $this->api->get("/api/aeronaves/{$id}");

        if (!$response['success']) {
            setFlash('danger', 'Aeronave no encontrada.');
            redirect(url('?page=aeronaves'));
        }

        view('aeronaves/show', [
            'title'    => 'Detalle de Aeronave',
            'aeronave' => $response['data']
        ]);
    }
}
