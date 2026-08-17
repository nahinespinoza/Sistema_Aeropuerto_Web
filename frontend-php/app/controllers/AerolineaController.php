<?php
/**
 * Controlador de Aerolíneas (responsabilidad de Nahin Espinoza)
 */
class AerolineaController
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Listar todas las aerolíneas (con filtro opcional por nombre)
     */
    public function index(): void
    {
        $nombre = $_GET['nombre'] ?? null;
        $params = $nombre ? ['nombre' => $nombre] : [];

        $response = $this->api->get('/api/aerolineas', $params);

        view('aerolineas/index', [
            'title'      => 'Aerolíneas',
            'aerolineas' => $response['success'] ? ($response['data'] ?? []) : [],
            'filtro'     => $nombre,
            'error'      => $response['success'] ? null : ($response['error'] ?? 'Error al cargar aerolíneas')
        ]);
    }

    /**
     * Formulario de registro
     */
    public function create(): void
    {
        view('aerolineas/create', [
            'title' => 'Registrar Aerolínea'
        ]);
    }

    /**
     * Guardar nueva aerolínea (+ flota opcional)
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=aerolineas'));
        }

        $codigo = trim($_POST['codigo'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $pais   = trim($_POST['pais'] ?? '');

        // Validación básica
        if (empty($codigo) || empty($nombre)) {
            setFlash('danger', 'El código y el nombre son obligatorios.');
            redirect(url('?page=aerolineas&action=create'));
        }

        // Construir flota desde el formulario dinámico
        $flota = [];
        $codigosAvion   = $_POST['avion_codigo'] ?? [];
        $nombresAvion   = $_POST['avion_nombre'] ?? [];
        $capacidades    = $_POST['avion_capacidad'] ?? [];
        $tipos          = $_POST['avion_tipo'] ?? [];

        for ($i = 0; $i < count($codigosAvion); $i++) {
            if (!empty(trim($codigosAvion[$i]))) {
                $flota[] = [
                    'codigo'    => trim($codigosAvion[$i]),
                    'nombre'    => trim($nombresAvion[$i] ?? ''),
                    'capacidad' => (int) ($capacidades[$i] ?? 0),
                    'tipo'      => trim($tipos[$i] ?? 'Comercial')
                ];
            }
        }

        $body = [
            'codigo' => strtoupper($codigo),
            'nombre' => $nombre,
            'pais'   => $pais,
            'flota'  => $flota
        ];

        $response = $this->api->post('/api/aerolineas', $body);

        if ($response['success']) {
            setFlash('success', 'Aerolínea registrada correctamente.');
            redirect(url('?page=aerolineas'));
        } else {
            setFlash('danger', $response['error'] ?? 'Error al registrar la aerolínea.');
            redirect(url('?page=aerolineas&action=create'));
        }
    }

    /**
     * Ver detalle de una aerolínea + su flota
     */
    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            setFlash('danger', 'ID de aerolínea no válido.');
            redirect(url('?page=aerolineas'));
        }

        $aerolinea = $this->api->get("/api/aerolineas/{$id}");
        $flota     = $this->api->get("/api/aerolineas/{$id}/flota");

        if (!$aerolinea['success']) {
            setFlash('danger', 'Aerolínea no encontrada.');
            redirect(url('?page=aerolineas'));
        }

        view('aerolineas/show', [
            'title'     => 'Detalle de Aerolínea',
            'aerolinea' => $aerolinea['data'],
            'flota'     => $flota['success'] ? ($flota['data'] ?? []) : []
        ]);
    }

    /**
     * Formulario de edición
     */
    public function edit(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aerolineas'));
        }

        $response = $this->api->get("/api/aerolineas/{$id}");

        if (!$response['success']) {
            setFlash('danger', 'Aerolínea no encontrada.');
            redirect(url('?page=aerolineas'));
        }

        view('aerolineas/edit', [
            'title'     => 'Editar Aerolínea',
            'aerolinea' => $response['data']
        ]);
    }

    /**
     * Actualizar aerolínea
     */
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=aerolineas'));
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aerolineas'));
        }

        $body = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'pais'   => trim($_POST['pais'] ?? '')
        ];

        $response = $this->api->put("/api/aerolineas/{$id}", $body);

        if ($response['success']) {
            setFlash('success', 'Aerolínea actualizada correctamente.');
        } else {
            setFlash('danger', $response['error'] ?? 'Error al actualizar.');
        }

        redirect(url("?page=aerolineas&action=show&id={$id}"));
    }

    /**
     * Eliminar aerolínea
     */
    public function delete(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aerolineas'));
        }

        $response = $this->api->delete("/api/aerolineas/{$id}");

        if ($response['success'] || $response['status'] === 204) {
            setFlash('success', 'Aerolínea eliminada correctamente.');
        } else {
            setFlash('danger', $response['error'] ?? 'Error al eliminar.');
        }

        redirect(url('?page=aerolineas'));
    }

    /**
     * Formulario para agregar aeronave a una aerolínea
     */
    public function addAeronaveForm(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aerolineas'));
        }

        $response = $this->api->get("/api/aerolineas/{$id}");
        if (!$response['success']) {
            setFlash('danger', 'Aerolínea no encontrada.');
            redirect(url('?page=aerolineas'));
        }

        view('aerolineas/add_aeronave', [
            'title'     => 'Agregar Aeronave',
            'aerolinea' => $response['data']
        ]);
    }

    /**
     * Guardar nueva aeronave en una aerolínea
     */
    public function storeAeronave(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=aerolineas'));
        }

        $aerolineaId = $_POST['aerolinea_id'] ?? null;
        if (!$aerolineaId) {
            redirect(url('?page=aerolineas'));
        }

        $body = [
            'codigo'    => trim($_POST['codigo'] ?? ''),
            'nombre'    => trim($_POST['nombre'] ?? ''),
            'capacidad' => (int) ($_POST['capacidad'] ?? 0),
            'tipo'      => trim($_POST['tipo'] ?? 'Comercial')
        ];

        $response = $this->api->post("/api/aerolineas/{$aerolineaId}/aeronaves", $body);

        if ($response['success']) {
            setFlash('success', 'Aeronave agregada correctamente.');
        } else {
            setFlash('danger', $response['error'] ?? 'Error al agregar la aeronave.');
        }

        redirect(url("?page=aerolineas&action=show&id={$aerolineaId}"));
    }
}
