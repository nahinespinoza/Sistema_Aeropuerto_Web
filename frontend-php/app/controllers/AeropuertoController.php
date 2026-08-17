<?php
/**
 * Controlador de Aeropuertos
 */
class AeropuertoController
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Listar aeropuertos (filtro opcional por ciudad o país)
     */
    public function index(): void
    {
        $ciudad = $_GET['ciudad'] ?? null;
        $pais   = $_GET['pais'] ?? null;

        $params = [];
        if ($ciudad) $params['ciudad'] = $ciudad;
        if ($pais)   $params['pais']   = $pais;

        $response = $this->api->get('/api/aeropuertos', $params);

        view('aeropuertos/index', [
            'title'       => 'Aeropuertos',
            'aeropuertos' => $response['success'] ? ($response['data'] ?? []) : [],
            'filtros'     => ['ciudad' => $ciudad, 'pais' => $pais],
            'error'       => $response['success'] ? null : ($response['error'] ?? 'Error al cargar aeropuertos. ¿Existe el endpoint /api/aeropuertos en el backend?')
        ]);
    }

    /**
     * Formulario de registro
     */
    public function create(): void
    {
        view('aeropuertos/create', [
            'title' => 'Registrar Aeropuerto'
        ]);
    }

    /**
     * Guardar nuevo aeropuerto
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=aeropuertos'));
        }

        $codigo = strtoupper(trim($_POST['codigo'] ?? ''));
        $nombre = trim($_POST['nombre'] ?? '');
        $ciudad = trim($_POST['ciudad'] ?? '');
        $pais   = trim($_POST['pais'] ?? '');

        if ($codigo === '' || $nombre === '' || $ciudad === '' || $pais === '') {
            setFlash('danger', 'Todos los campos son obligatorios.');
            redirect(url('?page=aeropuertos&action=create'));
        }

        $body = [
            'codigo' => $codigo,
            'nombre' => $nombre,
            'ciudad' => $ciudad,
            'pais'   => $pais
        ];

        $response = $this->api->post('/api/aeropuertos', $body);

        if ($response['success']) {
            setFlash('success', 'Aeropuerto registrado correctamente.');
            redirect(url('?page=aeropuertos'));
        }

        setFlash('danger', $response['error'] ?? 'Error al registrar el aeropuerto.');
        redirect(url('?page=aeropuertos&action=create'));
    }

    /**
     * Ver detalle
     */
    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aeropuertos'));
        }

        $response = $this->api->get("/api/aeropuertos/{$id}");

        if (!$response['success']) {
            setFlash('danger', 'Aeropuerto no encontrado.');
            redirect(url('?page=aeropuertos'));
        }

        view('aeropuertos/show', [
            'title'      => 'Detalle de Aeropuerto',
            'aeropuerto' => $response['data']
        ]);
    }

    /**
     * Formulario de edición
     */
    public function edit(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aeropuertos'));
        }

        $response = $this->api->get("/api/aeropuertos/{$id}");

        if (!$response['success']) {
            setFlash('danger', 'Aeropuerto no encontrado.');
            redirect(url('?page=aeropuertos'));
        }

        view('aeropuertos/edit', [
            'title'      => 'Editar Aeropuerto',
            'aeropuerto' => $response['data']
        ]);
    }

    /**
     * Actualizar aeropuerto
     */
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('?page=aeropuertos'));
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aeropuertos'));
        }

        $body = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'ciudad' => trim($_POST['ciudad'] ?? ''),
            'pais'   => trim($_POST['pais'] ?? '')
        ];

        $response = $this->api->put("/api/aeropuertos/{$id}", $body);

        if ($response['success']) {
            setFlash('success', 'Aeropuerto actualizado correctamente.');
            redirect(url("?page=aeropuertos&action=show&id={$id}"));
        }

        setFlash('danger', $response['error'] ?? 'Error al actualizar el aeropuerto.');
        redirect(url("?page=aeropuertos&action=edit&id={$id}"));
    }

    /**
     * Eliminar aeropuerto
     */
    public function delete(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect(url('?page=aeropuertos'));
        }

        $response = $this->api->delete("/api/aeropuertos/{$id}");

        if ($response['success'] || $response['status'] === 204) {
            setFlash('success', 'Aeropuerto eliminado correctamente.');
        } else {
            setFlash('danger', $response['error'] ?? 'Error al eliminar. Puede estar asociado a vuelos.');
        }

        redirect(url('?page=aeropuertos'));
    }
}
