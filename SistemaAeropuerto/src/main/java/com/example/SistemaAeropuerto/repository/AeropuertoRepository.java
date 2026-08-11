package com.example.SistemaAeropuerto.repository;

import com.example.SistemaAeropuerto.model.Aeropuerto;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.Optional;

@Repository
public interface AeropuertoRepository extends JpaRepository<Aeropuerto, Long> {

    // Buscar aeropuerto por su código  (ejm: "MEX", "BOG")
    Optional<Aeropuerto> findByCodigo(String codigo);

    // Buscar por ciudad
    List<Aeropuerto> findByCiudadContainingIgnoreCase(String ciudad);

    // Buscar por país
    List<Aeropuerto> findByPaisContainingIgnoreCase(String pais);

    // Verificar si existe un aeropuerto con ese código
    boolean existsByCodigo(String codigo);
}