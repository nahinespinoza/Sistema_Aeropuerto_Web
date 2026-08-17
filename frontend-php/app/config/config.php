<?php
/**
 * Configuración general del frontend
 */

// URL base del backend Spring Boot
define('API_BASE_URL', 'http://localhost:8080');

// Configuración de la aplicación
define('APP_NAME', 'Sistema Aeroportuario');
define('APP_VERSION', '1.0.0');

// Zona horaria
date_default_timezone_set('America/Guayaquil');

// Mostrar errores en desarrollo (cambiar a false en producción)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ruta base del proyecto (para includes)
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', dirname(BASE_PATH) . '/public');
