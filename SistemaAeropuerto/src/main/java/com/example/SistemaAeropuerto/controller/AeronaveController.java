package com.example.SistemaAeropuerto.controller;

import com.example.SistemaAeropuerto.model.Aeronave;
import com.example.SistemaAeropuerto.service.AeronaveService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/aeronaves")
@CrossOrigin(origins = "*")
public class AeronaveController {

    private final AeronaveService aeronaveService;

    public AeronaveController(AeronaveService aeronaveService) {
        this.aeronaveService = aeronaveService;
    }

    // GET /api/aeronaves
    @GetMapping
    public ResponseEntity<List<Aeronave>> listarTodas(
            @RequestParam(required = false) String tipo) {

        if (tipo != null && !tipo.isBlank()) {
            return ResponseEntity.ok(aeronaveService.buscarPorTipo(tipo));
        }
        return ResponseEntity.ok(aeronaveService.listarTodas());
    }

    // GET /api/aeronaves/{id}
    @GetMapping("/{id}")
    public ResponseEntity<?> obtenerPorId(@PathVariable Long id) {
        return aeronaveService.obtenerPorId(id)
                .map(ResponseEntity::ok)
                .orElse(ResponseEntity.notFound().build());
    }

    // PUT /api/aeronaves/{id}
    @PutMapping("/{id}")
    public ResponseEntity<?> actualizar(@PathVariable Long id,
                                        @RequestBody Aeronave datos) {
        try {
            Aeronave actualizada = aeronaveService.actualizar(id, datos);
            return ResponseEntity.ok(actualizada);
        } catch (RuntimeException e) {
            return ResponseEntity.notFound().build();
        }
    }

    // DELETE /api/aeronaves/{id}
    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminar(@PathVariable Long id) {
        try {
            aeronaveService.eliminar(id);
            return ResponseEntity.noContent().build();
        } catch (RuntimeException e) {
            return ResponseEntity.notFound().build();
        }
    }
}