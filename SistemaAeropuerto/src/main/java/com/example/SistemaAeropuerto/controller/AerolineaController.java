package com.example.SistemaAeropuerto.controller;

import com.example.SistemaAeropuerto.model.Aerolinea;
import com.example.SistemaAeropuerto.model.Aeronave;
import com.example.SistemaAeropuerto.service.AerolineaService;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/aerolineas")
@CrossOrigin(origins = "*") // Temporal, luego lo mejoramos con CorsConfig
public class AerolineaController {

    private final AerolineaService aerolineaService;

    public AerolineaController(AerolineaService aerolineaService) {
        this.aerolineaService = aerolineaService;
    }

    // ==================== REGISTRAR AEROLÍNEA + FLOTA ====================
    // POST /api/aerolineas
    @PostMapping
    public ResponseEntity<?> registrar(@RequestBody Map<String, Object> body) {
        try {
            // Extraer datos de la aerolínea
            Aerolinea aerolinea = new Aerolinea();
            aerolinea.setCodigo((String) body.get("codigo"));
            aerolinea.setNombre((String) body.get("nombre"));
            aerolinea.setPais((String) body.get("pais"));

            // Extraer la flota (lista de aviones)
            @SuppressWarnings("unchecked")
            List<Map<String, Object>> flotaData = (List<Map<String, Object>>) body.get("flota");

            List<Aeronave> flota = null;
            if (flotaData != null) {
                flota = flotaData.stream().map(avion -> {
                    Aeronave a = new Aeronave();
                    a.setCodigo((String) avion.get("codigo"));
                    a.setNombre((String) avion.get("nombre"));
                    a.setCapacidad((Integer) avion.get("capacidad"));
                    a.setTipo((String) avion.get("tipo"));
                    return a;
                }).toList();
            }

            Aerolinea guardada = aerolineaService.registrarAerolinea(aerolinea, flota);
            return ResponseEntity.status(HttpStatus.CREATED).body(guardada);

        } catch (RuntimeException e) {
            return ResponseEntity.badRequest().body(Map.of("error", e.getMessage()));
        }
    }

    // ==================== LISTAR TODAS ====================
    // GET /api/aerolineas
    @GetMapping
    public ResponseEntity<List<Aerolinea>> listarTodas(
            @RequestParam(required = false) String nombre) {

        List<Aerolinea> aerolineas;

        if (nombre != null && !nombre.isBlank()) {
            aerolineas = aerolineaService.buscarPorNombre(nombre);
        } else {
            aerolineas = aerolineaService.listarTodas();
        }

        return ResponseEntity.ok(aerolineas);
    }

    // ==================== OBTENER POR ID ====================
    // GET /api/aerolineas/{id}
    @GetMapping("/{id}")
    public ResponseEntity<?> obtenerPorId(@PathVariable Long id) {
        return aerolineaService.obtenerPorId(id)
                .map(ResponseEntity::ok)
                .orElse(ResponseEntity.notFound().build());
    }

    // ==================== OBTENER FLOTA DE UNA AEROLÍNEA ====================
    // GET /api/aerolineas/{id}/flota
    @GetMapping("/{id}/flota")
    public ResponseEntity<?> obtenerFlota(@PathVariable Long id) {
        if (aerolineaService.obtenerPorId(id).isEmpty()) {
            return ResponseEntity.notFound().build();
        }
        List<Aeronave> flota = aerolineaService.obtenerFlota(id);
        return ResponseEntity.ok(flota);
    }

    // ==================== AGREGAR AERONAVE A UNA AEROLÍNEA ====================
    // POST /api/aerolineas/{id}/aeronaves
    @PostMapping("/{id}/aeronaves")
    public ResponseEntity<?> agregarAeronave(@PathVariable Long id,
                                             @RequestBody Aeronave aeronave) {
        try {
            Aeronave guardada = aerolineaService.agregarAeronave(id, aeronave);
            return ResponseEntity.status(HttpStatus.CREATED).body(guardada);
        } catch (RuntimeException e) {
            return ResponseEntity.badRequest().body(Map.of("error", e.getMessage()));
        }
    }

    // ==================== ACTUALIZAR ====================
    // PUT /api/aerolineas/{id}
    @PutMapping("/{id}")
    public ResponseEntity<?> actualizar(@PathVariable Long id,
                                        @RequestBody Aerolinea datos) {
        try {
            Aerolinea actualizada = aerolineaService.actualizar(id, datos);
            return ResponseEntity.ok(actualizada);
        } catch (RuntimeException e) {
            return ResponseEntity.notFound().build();
        }
    }

    // ==================== ELIMINAR ====================
    // DELETE /api/aerolineas/{id}
    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminar(@PathVariable Long id) {
        try {
            aerolineaService.eliminar(id);
            return ResponseEntity.noContent().build();
        } catch (RuntimeException e) {
            return ResponseEntity.notFound().build();
        }
    }
}