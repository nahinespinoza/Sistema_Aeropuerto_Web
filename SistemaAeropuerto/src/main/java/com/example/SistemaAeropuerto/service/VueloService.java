package com.example.SistemaAeropuerto.service;

import com.example.SistemaAeropuerto.model.Aerolinea;
import com.example.SistemaAeropuerto.model.Aeronave;
import com.example.SistemaAeropuerto.model.Aeropuerto;
import com.example.SistemaAeropuerto.model.Vuelo;
import com.example.SistemaAeropuerto.repository.AerolineaRepository;
import com.example.SistemaAeropuerto.repository.AeronaveRepository;
import com.example.SistemaAeropuerto.repository.AeropuertoRepository;
import com.example.SistemaAeropuerto.repository.VueloRepository;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;

@Service
public class VueloService {

    private final VueloRepository vueloRepository;
    private final AerolineaRepository aerolineaRepository;
    private final AeronaveRepository aeronaveRepository;
    private final AeropuertoRepository aeropuertoRepository;

    public VueloService(
            VueloRepository vueloRepository,
            AerolineaRepository aerolineaRepository,
            AeronaveRepository aeronaveRepository,
            AeropuertoRepository aeropuertoRepository) {

        this.vueloRepository = vueloRepository;
        this.aerolineaRepository = aerolineaRepository;
        this.aeronaveRepository = aeronaveRepository;
        this.aeropuertoRepository = aeropuertoRepository;
    }

    // ==================== REGISTRAR VUELO ====================

    @Transactional
    public Vuelo registrarVuelo(
            String numeroVuelo,
            Long aerolineaId,
            Long aeronaveId,
            Long origenId,
            Long destinoId,
            LocalDateTime horaSalida,
            LocalDateTime horaLlegada,
            Double distancia) {

        // Verificar que no exista otro vuelo con el mismo número
        if (!vueloRepository.findByNumeroVuelo(numeroVuelo).isEmpty()) {
            throw new RuntimeException(
                    "Ya existe un vuelo con el número: " + numeroVuelo
            );
        }

        // Buscar aerolínea
        Aerolinea aerolinea = aerolineaRepository.findById(aerolineaId)
                .orElseThrow(() -> new RuntimeException(
                        "Aerolínea no encontrada con id: " + aerolineaId
                ));

        // Buscar aeronave
        Aeronave aeronave = aeronaveRepository.findById(aeronaveId)
                .orElseThrow(() -> new RuntimeException(
                        "Aeronave no encontrada con id: " + aeronaveId
                ));

        // Buscar aeropuerto de origen
        Aeropuerto origen = aeropuertoRepository.findById(origenId)
                .orElseThrow(() -> new RuntimeException(
                        "Aeropuerto de origen no encontrado con id: " + origenId
                ));

        // Buscar aeropuerto de destino
        Aeropuerto destino = aeropuertoRepository.findById(destinoId)
                .orElseThrow(() -> new RuntimeException(
                        "Aeropuerto de destino no encontrado con id: " + destinoId
                ));

        // Validar que origen y destino sean diferentes
        if (origenId.equals(destinoId)) {
            throw new RuntimeException(
                    "El aeropuerto de origen y destino no pueden ser iguales."
            );
        }

        // Validar horarios
        if (horaLlegada.isBefore(horaSalida) ||
                horaLlegada.isEqual(horaSalida)) {

            throw new RuntimeException(
                    "La hora de llegada debe ser posterior a la hora de salida."
            );
        }

        // Crear vuelo
        Vuelo vuelo = new Vuelo();

        vuelo.setNumeroVuelo(numeroVuelo);
        vuelo.setAerolinea(aerolinea);
        vuelo.setAeronave(aeronave);
        vuelo.setOrigen(origen);
        vuelo.setDestino(destino);
        vuelo.setHoraSalida(horaSalida);
        vuelo.setHoraLlegada(horaLlegada);
        vuelo.setDistancia(distancia);
        vuelo.setActivo(true);

        // Guardar
        return vueloRepository.save(vuelo);
    }


    public List<Vuelo> listarTodos() {
        return vueloRepository.findAll();
    }


    public List<Vuelo> listarActivos() {
        return vueloRepository.findByActivoTrue();
    }

    // ==================== CONSULTAR POR FILTROS ====================

    public List<Vuelo> buscarVuelos(
            LocalDate fecha,
            String origen,
            String destino) {

        // Fecha + origen + destino
        if (fecha != null && origen != null && destino != null) {

            LocalDateTime inicio = fecha.atStartOfDay();
            LocalDateTime fin = fecha.plusDays(1).atStartOfDay();

            return vueloRepository
                    .findByActivoTrueAndHoraSalidaBetween(inicio, fin)
                    .stream()
                    .filter(vuelo ->
                            vuelo.getOrigen()
                                    .getCiudad()
                                    .equalsIgnoreCase(origen)
                            &&
                            vuelo.getDestino()
                                    .getCiudad()
                                    .equalsIgnoreCase(destino)
                    )
                    .toList();
        }

        // Solo fecha
        if (fecha != null) {

            LocalDateTime inicio = fecha.atStartOfDay();
            LocalDateTime fin = fecha.plusDays(1).atStartOfDay();

            return vueloRepository
                    .findByActivoTrueAndHoraSalidaBetween(inicio, fin);
        }

        // Solo origen
        if (origen != null && destino == null) {

            return vueloRepository
                    .findByActivoTrueAndOrigenCiudadIgnoreCase(origen);
        }

        // Solo destino
        if (destino != null && origen == null) {

            return vueloRepository
                    .findByActivoTrueAndDestinoCiudadIgnoreCase(destino);
        }

        // Origen + destino
        if (origen != null && destino != null) {

            return vueloRepository
                    .findByActivoTrueAndOrigenCiudadIgnoreCaseAndDestinoCiudadIgnoreCase(
                            origen,
                            destino
                    );
        }

        // Sin filtros
        return vueloRepository.findByActivoTrue();
    }

    // ==================== OBTENER POR ID ====================

    public Vuelo obtenerPorId(Long id) {

        return vueloRepository.findById(id)
                .orElseThrow(() -> new RuntimeException(
                        "Vuelo no encontrado con id: " + id
                ));
    }

    // ==================== DESACTIVAR VUELO ====================

    @Transactional
    public void desactivarVuelo(Long id) {

        Vuelo vuelo = obtenerPorId(id);

        vuelo.setActivo(false);

        vueloRepository.save(vuelo);
    }
}
