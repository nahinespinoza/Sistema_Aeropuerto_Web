package com.example.SistemaAeropuerto.controller;

import com.example.SistemaAeropuerto.model.Vuelo;
import com.example.SistemaAeropuerto.service.VueloService;
import org.springframework.format.annotation.DateTimeFormat;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;

@RestController
@RequestMapping("/api/vuelos")
@CrossOrigin(origins = "*")
public class VueloController {

    private final VueloService vueloService;

    public VueloController(VueloService vueloService) {
        this.vueloService = vueloService;
    }

    // ==================== REGISTRAR VUELO ====================

    @PostMapping
    public ResponseEntity<Vuelo> registrarVuelo(
            @RequestParam String numeroVuelo,
            @RequestParam Long aerolineaId,
            @RequestParam Long aeronaveId,
            @RequestParam Long origenId,
            @RequestParam Long destinoId,
            @RequestParam
            @DateTimeFormat(iso = DateTimeFormat.ISO.DATE_TIME)
            LocalDateTime horaSalida,
            @RequestParam
            @DateTimeFormat(iso = DateTimeFormat.ISO.DATE_TIME)
            LocalDateTime horaLlegada,
            @RequestParam Double distancia) {

        Vuelo vuelo = vueloService.registrarVuelo(
                numeroVuelo,
                aerolineaId,
                aeronaveId,
                origenId,
                destinoId,
                horaSalida,
                horaLlegada,
                distancia
        );

        return ResponseEntity.status(HttpStatus.CREATED).body(vuelo);
    }

    // ==================== CONSULTAR VUELOS ====================

    @GetMapping
    public ResponseEntity<List<Vuelo>> consultarVuelos(
            @RequestParam(required = false)
            @DateTimeFormat(iso = DateTimeFormat.ISO.DATE)
            LocalDate fecha,

            @RequestParam(required = false)
            String origen,

            @RequestParam(required = false)
            String destino) {

        List<Vuelo> vuelos = vueloService.buscarVuelos(
                fecha,
                origen,
                destino
        );

        return ResponseEntity.ok(vuelos);
    }

    // ==================== OBTENER VUELO POR ID ====================

    @GetMapping("/{id}")
    public ResponseEntity<Vuelo> obtenerPorId(@PathVariable Long id) {

        Vuelo vuelo = vueloService.obtenerPorId(id);

        return ResponseEntity.ok(vuelo);
    }

    // ==================== DESACTIVAR VUELO ====================

    @PutMapping("/{id}/desactivar")
    public ResponseEntity<Void> desactivarVuelo(
            @PathVariable Long id) {

        vueloService.desactivarVuelo(id);

        return ResponseEntity.noContent().build();
    }
}
