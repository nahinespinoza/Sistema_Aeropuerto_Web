package com.example.SistemaAeropuerto.repository;

import com.example.SistemaAeropuerto.model.Aeronave;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface AeronaveRepository extends JpaRepository<Aeronave, Long> {

    // Obtener toda la flota de una aerolínea
    List<Aeronave> findByAerolineaId(Long aerolineaId);

    // Buscar aeronaves por tipo (ejm : Comercial, Carga, etc)
    List<Aeronave> findByTipo(String tipo);

    // Buscar por código de aeronave
    List<Aeronave> findByCodigo(String codigo);
}