<?php
/**
 * Front Controller - Punto de entrada de la aplicación
 */

// Iniciar sesión
session_start();

// Cargar configuración y helpers
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/models/ApiClient.php';

// Cargar controladores
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AerolineaController.php';
require_once __DIR__ . '/../app/controllers/AeronaveController.php';
require_once __DIR__ . '/../app/controllers/AeropuertoController.php';
require_once __DIR__ . '/../app/controllers/VueloController.php';

// Router simple
$page   = $_GET['page']   ?? 'home';
$action = $_GET['action'] ?? 'index';

try {
    switch ($page) {
        case 'home':
            $controller = new HomeController();
            $controller->index();
            break;

        case 'aerolineas':
            $controller = new AerolineaController();
            match ($action) {
                'create'        => $controller->create(),
                'store'         => $controller->store(),
                'show'          => $controller->show(),
                'edit'          => $controller->edit(),
                'update'        => $controller->update(),
                'delete'        => $controller->delete(),
                'addAeronave'   => $controller->addAeronaveForm(),
                'storeAeronave' => $controller->storeAeronave(),
                default         => $controller->index(),
            };
            break;

        case 'aeronaves':
            $controller = new AeronaveController();
            match ($action) {
                'create' => $controller->create(),
                'store'  => $controller->store(),
                'show'   => $controller->show(),
                default  => $controller->index(),
            };
            break;

        case 'aeropuertos':
            $controller = new AeropuertoController();
            match ($action) {
                'create' => $controller->create(),
                'store'  => $controller->store(),
                'show'   => $controller->show(),
                'edit'   => $controller->edit(),
                'update' => $controller->update(),
                'delete' => $controller->delete(),
                default  => $controller->index(),
            };
            break;

        case 'vuelos':
            $controller = new VueloController();
            match ($action) {
                'show'  => $controller->show(),
                default => $controller->index(),
            };
            break;

        default:
            http_response_code(404);
            echo '<h1>404 - Página no encontrada</h1>';
            echo '<a href="' . url() . '">Volver al inicio</a>';
            break;
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo '<div style="font-family:sans-serif;padding:2rem;">';
    echo '<h1>Error del servidor</h1>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<a href="' . url() . '">Volver al inicio</a>';
    echo '</div>';
}
