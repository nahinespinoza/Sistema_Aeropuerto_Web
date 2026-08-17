# Frontend PHP - Sistema Aeroportuario

Interfaz web en PHP para el **Sistema Web Distribuido de Gestión Aeroportuaria**.

Se comunica con el backend **Java Spring Boot** mediante peticiones HTTP/REST (JSON).

## Requisitos

- PHP 8.0 o superior (con extensión `curl` habilitada)
- Backend Spring Boot corriendo en `http://localhost:8080`
- Servidor web (Apache con `mod_rewrite`, o el servidor embebido de PHP)

## Estructura

```
frontend-php/
├── public/                 ← Document root (apunta aquí el servidor)
│   ├── index.php           ← Front controller
│   ├── .htaccess
│   └── assets/
│       ├── css/style.css
│       └── js/app.js
├── app/
│   ├── config/config.php   ← URL del backend
│   ├── controllers/        ← Lógica de cada módulo
│   ├── models/ApiClient.php
│   ├── views/              ← Plantillas HTML
│   └── helpers/functions.php
└── README.md
```

## Cómo ejecutar

### Opción 1: Servidor embebido de PHP (desarrollo)

```bash
cd frontend-php/public
php -S localhost:8000
```

Abre: http://localhost:8000

### Opción 2: Apache / XAMPP / Laragon

1. Copia la carpeta `frontend-php` a `htdocs` (o `www`).
2. Configura el DocumentRoot a `frontend-php/public`.
3. Asegúrate de que `mod_rewrite` esté activo.

## Configuración

Edita `app/config/config.php` si el backend no está en `http://localhost:8080`:

```php
define('API_BASE_URL', 'http://localhost:8080');
```

## Módulos implementados

| Módulo       | Funcionalidades                                      | Responsable      |
|--------------|------------------------------------------------------|------------------|
| Aerolíneas   | Listar, filtrar, registrar (+flota), editar, eliminar, ver flota, agregar aeronave | **Nahin Espinoza** |
| Aeronaves    | Listar, filtrar por tipo, ver detalle                | Nahin Espinoza   |
| Vuelos       | Buscar por fecha/origen/destino, ver detalle         | Julian Rojas     |
| Home         | Panel con estadísticas                               | Ambos            |

## Endpoints que consume

- `GET/POST/PUT/DELETE /api/aerolineas`
- `GET /api/aerolineas/{id}/flota`
- `POST /api/aerolineas/{id}/aeronaves`
- `GET /api/aeronaves`
- `GET /api/vuelos`

## Notas

- Los datos del backend (H2) se pierden al reiniciar Spring Boot.
- No hay autenticación aún (el CORS del backend está abierto con `*`).
- El registro de vuelos desde el frontend aún no está implementado (usa `@RequestParam` en el backend).
