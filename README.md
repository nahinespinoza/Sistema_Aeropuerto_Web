# Sistema_Aeropuerto_Web

# Sistema_Aeropuerto_Web

Sistema Web Distribuido de Gestión Aeroportuaria.

- **Backend**: Java + Spring Boot (REST API + H2)
- **Frontend**: PHP (consume la API del backend)

---

## Estructura del repositorio

```
Sistema_Aeropuerto_Web/
├── SistemaAeropuerto/     ← Backend (Spring Boot)
└── frontend-php/          ← Frontend (PHP)
```

---

## Requisitos generales

| Componente          | Versión / Herramienta                  |
|---------------------|----------------------------------------|
| **Java**            | 17 o superior                          |
| **Maven**           | 3.8+ (o usar el wrapper `mvnw` incluido) |
| **Spring Boot**     | 4.1.0                                  |
| **PHP**             | 8.0 o superior (con extensión `curl`)  |
| **Servidor web**    | Servidor embebido de PHP o Apache/XAMPP/Laragon |

---

## Backend (Spring Boot)

### Tecnologías y dependencias principales

- **Spring Boot** `4.1.0`
- **Java** `17`
- **Spring Web MVC**
- **Spring Data JPA**
- **Spring Validation**
- **H2 Database** (en memoria)
- **Lombok**
- **Spring Boot DevTools**

### Cómo ejecutar el backend

1. Abre una terminal y entra a la carpeta del backend:

```bash
cd SistemaAeropuerto
```

2. Ejecuta la aplicación con el Maven Wrapper (recomendado):

**Linux / macOS:**
```bash
./mvnw spring-boot:run
```

**Windows:**
```bash
mvnw.cmd spring-boot:run
```

3. El backend quedará disponible en:

```
http://localhost:8080
```

### Consola de H2 (opcional)

Puedes inspeccionar la base de datos en:

```
http://localhost:8080/h2-console
```

- **JDBC URL**: `jdbc:h2:mem:aeropuertosdb`
- **Usuario**: `sa`
- **Contraseña**: (vacía)

> **Nota**: La base de datos es en memoria. Los datos se pierden al reiniciar el servidor.

### Endpoints principales de la API

- `GET/POST/PUT/DELETE /api/aerolineas`
- `GET /api/aerolineas/{id}/flota`
- `POST /api/aerolineas/{id}/aeronaves`
- `GET /api/aeronaves`
- `GET /api/vuelos`
- `GET /api/vuelos/{id}`

---

## Frontend (PHP)

### Requisitos

- PHP **8.0+**
- Extensión **curl** habilitada
- Backend Spring Boot corriendo en `http://localhost:8080`

### Cómo ejecutar el frontend

#### Opción 1: Servidor embebido de PHP (recomendado para desarrollo)

```bash
cd frontend-php/public
php -S localhost:8000
```

Abre el navegador en:

```
http://localhost:8000
```

#### Opción 2: Apache / XAMPP / Laragon

1. Copia la carpeta `frontend-php` a `htdocs` (o `www`).
2. Configura el **DocumentRoot** apuntando a `frontend-php/public`.
3. Asegúrate de que `mod_rewrite` esté activo.

### Configuración del frontend

Si el backend no está en `http://localhost:8080`, edita:

```
frontend-php/app/config/config.php
```

```php
define('API_BASE_URL', 'http://localhost:8080');
```

---

## Flujo recomendado para probar todo

1. **Inicia el backend** primero:
   ```bash
   cd SistemaAeropuerto
   ./mvnw spring-boot:run
   ```

2. **En otra terminal, inicia el frontend**:
   ```bash
   cd frontend-php/public
   php -S localhost:8000
   ```

3. Abre el navegador en `http://localhost:8000`.

---

## Notas 

- No hay autenticación implementada todavía.
- El CORS del backend está abierto (`*`).
- Los datos de H2 se reinician cada vez que se detiene el backend.
- El registro de vuelos desde el frontend aún no está completamente implementado.

---

## Autores

- **Nahin Espinoza** – Módulos de Aerolíneas y Aeronaves
- **Julian Rojas** – Módulo de Vuelos
```
