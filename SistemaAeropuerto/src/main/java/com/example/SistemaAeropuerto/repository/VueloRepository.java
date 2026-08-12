package com.example.SistemaAeropuerto.repository;

import com.example.SistemaAeropuerto.model.Vuelo;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.time.LocalDateTime;
import java.util.List;

@Repository
public interface VueloRepository extends JpaRepository<Vuelo, Long> {

    // Buscar por número de vuelo
    List<Vuelo> findByNumeroVuelo(String numeroVuelo);

    // Buscar vuelos de una aerolínea
    List<Vuelo> findByAerolineaId(Long aerolineaId);

    // Buscar vuelos que salen de un aeropuerto
    List<Vuelo> findByOrigenId(Long origenId);

    // Buscar vuelos que llegan a un aeropuerto
    List<Vuelo> findByDestinoId(Long destinoId);

    // Buscar vuelos entre dos aeropuertos
    List<Vuelo> findByOrigenIdAndDestinoId(Long origenId, Long destinoId);

    // Buscar vuelos activos
    List<Vuelo> findByActivoTrue();

    // Buscar vuelos activos por fecha de salida
    List<Vuelo> findByActivoTrueAndHoraSalidaBetween(
            LocalDateTime inicio,
            LocalDateTime fin
    );

    // Buscar vuelos activos por ciudad de origen
    List<Vuelo> findByActivoTrueAndOrigenCiudadIgnoreCase(
            String ciudad
    );

    // Buscar vuelos activos por ciudad de destino
    List<Vuelo> findByActivoTrueAndDestinoCiudadIgnoreCase(
            String ciudad
    );

    // Buscar vuelos activos por ciudad de origen y destino
    List<Vuelo> findByActivoTrueAndOrigenCiudadIgnoreCaseAndDestinoCiudadIgnoreCase(
            String origen,
            String destino
    );
}