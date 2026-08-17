package com.example.SistemaAeropuerto.controller;

import com.example.SistemaAeropuerto.model.Aeropuerto;
import com.example.SistemaAeropuerto.service.AeropuertoService;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/aeropuertos")
@CrossOrigin(origins = "*")
public class AeropuertoController {

    private final AeropuertoService aeropuertoService;

    public AeropuertoController(AeropuertoService aeropuertoService) {
        this.aeropuertoService = aeropuertoService;
    }

    // ==================== REGISTRAR ====================
    // POST /api/aeropuertos
    @PostMapping
    public ResponseEntity<?> registrar(@RequestBody Aeropuerto aeropuerto) {
        try {
            Aeropuerto guardado = aeropuertoService.registrar(aeropuerto);
            return ResponseEntity.status(HttpStatus.CREATED).body(guardado);
        } catch (RuntimeException e) {
            return ResponseEntity.badRequest().body(Map.of("error", e.getMessage()));
        }
    }

    // ==================== LISTAR / BUSCAR ====================
    // GET /api/aeropuertos
    // GET /api/aeropuertos?ciudad=Bogotá
    // GET /api/aeropuertos?pais=Colombia
    @GetMapping
    public ResponseEntity<List<Aeropuerto>> listar(
            @RequestParam(required = false) String ciudad,
            @RequestParam(required = false) String pais) {

        List<Aeropuerto> aeropuertos;

        if (ciudad != null && !ciudad.isBlank()) {
            aeropuertos = aeropuertoService.buscarPorCiudad(ciudad);
        } else if (pais != null && !pais.isBlank()) {
            aeropuertos = aeropuertoService.buscarPorPais(pais);
        } else {
            aeropuertos = aeropuertoService.listarTodos();
        }

        return ResponseEntity.ok(aeropuertos);
    }

    // ==================== OBTENER POR ID ====================
    // GET /api/aeropuertos/{id}
    @GetMapping("/{id}")
    public ResponseEntity<?> obtenerPorId(@PathVariable Long id) {
        return aeropuertoService.obtenerPorId(id)
                .map(ResponseEntity::ok)
                .orElse(ResponseEntity.notFound().build());
    }

    // ==================== ACTUALIZAR ====================
    // PUT /api/aeropuertos/{id}
    @PutMapping("/{id}")
    public ResponseEntity<?> actualizar(@PathVariable Long id,
                                        @RequestBody Aeropuerto datos) {
        try {
            Aeropuerto actualizado = aeropuertoService.actualizar(id, datos);
            return ResponseEntity.ok(actualizado);
        } catch (RuntimeException e) {
            return ResponseEntity.notFound().build();
        }
    }

    // ==================== ELIMINAR ====================
    // DELETE /api/aeropuertos/{id}
    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminar(@PathVariable Long id) {
        try {
            aeropuertoService.eliminar(id);
            return ResponseEntity.noContent().build();
        } catch (RuntimeException e) {
            return ResponseEntity.notFound().build();
        }
    }
}