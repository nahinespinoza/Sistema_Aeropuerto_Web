package com.example.SistemaAeropuerto.repository;

import com.example.SistemaAeropuerto.model.Aerolinea;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.Optional;

@Repository
public interface AerolineaRepository extends JpaRepository<Aerolinea, Long> {

    // Buscar aerolínea por su código (ejm: "AV", "IB")
    Optional<Aerolinea> findByCodigo(String codigo);

    // Buscar aerolíneas por nombre 
    List<Aerolinea> findByNombreContainingIgnoreCase(String nombre);

    // Verificar si ya existe una aerolínea con ese código
    boolean existsByCodigo(String codigo);
}