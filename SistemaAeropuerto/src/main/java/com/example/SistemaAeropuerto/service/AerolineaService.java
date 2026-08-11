package com.example.SistemaAeropuerto.service;

import com.example.SistemaAeropuerto.model.Aerolinea;
import com.example.SistemaAeropuerto.model.Aeronave;
import com.example.SistemaAeropuerto.repository.AerolineaRepository;
import com.example.SistemaAeropuerto.repository.AeronaveRepository;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.Optional;

@Service
public class AerolineaService {

    private final AerolineaRepository aerolineaRepository;
    private final AeronaveRepository aeronaveRepository;

    // Inyección de dependencias por constructor (recomendado)
    public AerolineaService(AerolineaRepository aerolineaRepository,
                            AeronaveRepository aeronaveRepository) {
        this.aerolineaRepository = aerolineaRepository;
        this.aeronaveRepository = aeronaveRepository;
    }

    // ==================== REGISTRAR ====================
    @Transactional
    public Aerolinea registrarAerolinea(Aerolinea aerolinea, List<Aeronave> aeronaves) {
        // Validar que el código no exista
        if (aerolineaRepository.existsByCodigo(aerolinea.getCodigo())) {
            throw new RuntimeException("Ya existe una aerolínea con el código: " + aerolinea.getCodigo());
        }

        // Guardar la aerolínea
        Aerolinea aerolineaGuardada = aerolineaRepository.save(aerolinea);

        // Asociar y guardar las aeronaves
        if (aeronaves != null && !aeronaves.isEmpty()) {
            for (Aeronave aeronave : aeronaves) {
                aeronave.setAerolinea(aerolineaGuardada);
                aeronaveRepository.save(aeronave);
            }
        }

        return aerolineaGuardada;
    }

    // ==================== LISTAR ====================
    public List<Aerolinea> listarTodas() {
        return aerolineaRepository.findAll();
    }

    public List<Aerolinea> buscarPorNombre(String nombre) {
        return aerolineaRepository.findByNombreContainingIgnoreCase(nombre);
    }

    // ==================== OBTENER UNA ====================
    public Optional<Aerolinea> obtenerPorId(Long id) {
        return aerolineaRepository.findById(id);
    }

    public Optional<Aerolinea> obtenerPorCodigo(String codigo) {
        return aerolineaRepository.findByCodigo(codigo);
    }

    // ==================== OBTENER FLOTA ====================
    public List<Aeronave> obtenerFlota(Long aerolineaId) {
        return aeronaveRepository.findByAerolineaId(aerolineaId);
    }

    // ==================== ACTUALIZAR ====================
    @Transactional
    public Aerolinea actualizar(Long id, Aerolinea datosActualizados) {
        Aerolinea aerolinea = aerolineaRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Aerolínea no encontrada con id: " + id));

        aerolinea.setNombre(datosActualizados.getNombre());
        aerolinea.setPais(datosActualizados.getPais());
        // El código normalmente no se cambia

        return aerolineaRepository.save(aerolinea);
    }

    // ==================== ELIMINAR ====================
    @Transactional
    public void eliminar(Long id) {
        if (!aerolineaRepository.existsById(id)) {
            throw new RuntimeException("Aerolínea no encontrada con id: " + id);
        }
        aerolineaRepository.deleteById(id);
    }

    // ==================== AGREGAR AERONAVE A UNA AEROLÍNEA ====================
    @Transactional
    public Aeronave agregarAeronave(Long aerolineaId, Aeronave aeronave) {
        Aerolinea aerolinea = aerolineaRepository.findById(aerolineaId)
                .orElseThrow(() -> new RuntimeException("Aerolínea no encontrada con id: " + aerolineaId));

        aeronave.setAerolinea(aerolinea);
        return aeronaveRepository.save(aeronave);
    }
}