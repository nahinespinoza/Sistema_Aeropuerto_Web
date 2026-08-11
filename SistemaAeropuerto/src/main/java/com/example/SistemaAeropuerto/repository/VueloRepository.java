package com.example.SistemaAeropuerto.repository;

import com.example.SistemaAeropuerto.model.Vuelo;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface VueloRepository extends JpaRepository<Vuelo, Long> {

    // Buscar vuelos por número de vuelo
    List<Vuelo> findByNumeroVuelo(String numeroVuelo);

    // Buscar vuelos de una aerolínea
    List<Vuelo> findByAerolineaContainingIgnoreCase(String aerolinea);

    // Buscar vuelos que salen de un aeropuerto
    List<Vuelo> findByOrigenId(Long origenId);

    // Buscar vuelos que llegan a un aeropuerto
    List<Vuelo> findByDestinoId(Long destinoId);

    // Buscar vuelos entre dos aeropuertos
    List<Vuelo> findByOrigenIdAndDestinoId(Long origenId, Long destinoId);
}