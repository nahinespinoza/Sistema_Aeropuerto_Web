<?php
/**
 * Funciones auxiliares
 */

/**
 * Renderiza una vista
 */
function view(string $view, array $data = [], string $layout = 'main'): void
{
    extract($data);

    $viewFile = BASE_PATH . '/views/' . $view . '.php';
    $layoutFile = BASE_PATH . '/views/layouts/' . $layout . '.php';

    if (!file_exists($viewFile)) {
        die("Vista no encontrada: {$view}");
    }

    // Capturar el contenido de la vista
    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    // Renderizar el layout con el contenido
    require $layoutFile;
}

/**
 * Redirige a una URL
 */
function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/**
 * Escapa HTML para evitar XSS
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Formatea una fecha legible
 */
function formatDate(?string $date, string $format = 'd/m/Y H:i'): string
{
    if (!$date) return '-';
    try {
        $dt = new DateTime($date);
        return $dt->format($format);
    } catch (Exception $e) {
        return $date;
    }
}

/**
 * Muestra mensajes flash (éxito / error)
 */
function setFlash(string $type, string $message): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Genera URL relativa al public
 */
function url(string $path = ''): string
{
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    return $base . '/' . ltrim($path, '/');
}
