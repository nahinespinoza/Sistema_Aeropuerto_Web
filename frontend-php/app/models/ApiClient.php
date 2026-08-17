<?php
/**
 * Cliente HTTP para comunicarse con la API REST de Spring Boot
 */
class ApiClient
{
    private string $baseUrl;

    public function __construct(string $baseUrl = API_BASE_URL)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * GET request
     */
    public function get(string $endpoint, array $params = []): array
    {
        $url = $this->baseUrl . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        return $this->request('GET', $url);
    }

    /**
     * POST request con body JSON
     */
    public function post(string $endpoint, array $body = []): array
    {
        $url = $this->baseUrl . $endpoint;
        return $this->request('POST', $url, $body);
    }

    /**
     * POST con query params (útil para el endpoint de vuelos)
     */
    public function postWithParams(string $endpoint, array $params = []): array
    {
        $url = $this->baseUrl . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return $this->request('POST', $url);
    }

    /**
     * PUT request
     */
    public function put(string $endpoint, array $body = []): array
    {
        $url = $this->baseUrl . $endpoint;
        return $this->request('PUT', $url, $body);
    }

    /**
     * DELETE request
     */
    public function delete(string $endpoint): array
    {
        $url = $this->baseUrl . $endpoint;
        return $this->request('DELETE', $url);
    }

    /**
     * Ejecuta la petición cURL
     */
    private function request(string $method, string $url, ?array $body = null): array
    {
        $ch = curl_init($url);

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_CONNECTTIMEOUT => 5,
        ];

        if ($body !== null && in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $options[CURLOPT_POSTFIELDS] = json_encode($body);
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return [
                'success' => false,
                'status'  => 0,
                'error'   => 'Error de conexión: ' . $error,
                'data'    => null
            ];
        }

        $data = json_decode($response, true);

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'status'  => $httpCode,
            'data'    => $data,
            'error'   => ($httpCode >= 400) ? ($data['error'] ?? 'Error del servidor') : null
        ];
    }
}
