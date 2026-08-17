package com.example.SistemaAeropuerto.service;

import com.example.SistemaAeropuerto.model.Aeropuerto;
import com.example.SistemaAeropuerto.repository.AeropuertoRepository;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.Optional;

@Service
public class AeropuertoService {

    private final AeropuertoRepository aeropuertoRepository;

    public AeropuertoService(AeropuertoRepository aeropuertoRepository) {
        this.aeropuertoRepository = aeropuertoRepository;
    }

    // ==================== REGISTRAR ====================
    @Transactional
    public Aeropuerto registrar(Aeropuerto aeropuerto) {
        if (aeropuerto.getCodigo() == null || aeropuerto.getCodigo().isBlank()) {
            throw new RuntimeException("El código del aeropuerto es obligatorio");
        }

        String codigo = aeropuerto.getCodigo().trim().toUpperCase();
        aeropuerto.setCodigo(codigo);

        if (aeropuertoRepository.existsByCodigo(codigo)) {
            throw new RuntimeException("Ya existe un aeropuerto con el código: " + codigo);
        }

        if (aeropuerto.getNombre() == null || aeropuerto.getNombre().isBlank()) {
            throw new RuntimeException("El nombre del aeropuerto es obligatorio");
        }
        if (aeropuerto.getCiudad() == null || aeropuerto.getCiudad().isBlank()) {
            throw new RuntimeException("La ciudad es obligatoria");
        }
        if (aeropuerto.getPais() == null || aeropuerto.getPais().isBlank()) {
            throw new RuntimeException("El país es obligatorio");
        }

        return aeropuertoRepository.save(aeropuerto);
    }

    // ==================== LISTAR ====================
    public List<Aeropuerto> listarTodos() {
        return aeropuertoRepository.findAll();
    }

    public List<Aeropuerto> buscarPorCiudad(String ciudad) {
        return aeropuertoRepository.findByCiudadContainingIgnoreCase(ciudad);
    }

    public List<Aeropuerto> buscarPorPais(String pais) {
        return aeropuertoRepository.findByPaisContainingIgnoreCase(pais);
    }

    // ==================== OBTENER ====================
    public Optional<Aeropuerto> obtenerPorId(Long id) {
        return aeropuertoRepository.findById(id);
    }

    public Optional<Aeropuerto> obtenerPorCodigo(String codigo) {
        return aeropuertoRepository.findByCodigo(codigo);
    }

    // ==================== ACTUALIZAR ====================
    @Transactional
    public Aeropuerto actualizar(Long id, Aeropuerto datos) {
        Aeropuerto aeropuerto = aeropuertoRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Aeropuerto no encontrado con id: " + id));

        // El código normalmente no se cambia
        if (datos.getNombre() != null && !datos.getNombre().isBlank()) {
            aeropuerto.setNombre(datos.getNombre().trim());
        }
        if (datos.getCiudad() != null && !datos.getCiudad().isBlank()) {
            aeropuerto.setCiudad(datos.getCiudad().trim());
        }
        if (datos.getPais() != null && !datos.getPais().isBlank()) {
            aeropuerto.setPais(datos.getPais().trim());
        }

        return aeropuertoRepository.save(aeropuerto);
    }

    // ==================== ELIMINAR ====================
    @Transactional
    public void eliminar(Long id) {
        if (!aeropuertoRepository.existsById(id)) {
            throw new RuntimeException("Aeropuerto no encontrado con id: " + id);
        }
        aeropuertoRepository.deleteById(id);
    }
}