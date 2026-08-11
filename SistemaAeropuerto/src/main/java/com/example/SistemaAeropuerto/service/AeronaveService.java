package com.example.SistemaAeropuerto.service;

import com.example.SistemaAeropuerto.model.Aeronave;
import com.example.SistemaAeropuerto.repository.AeronaveRepository;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.Optional;

@Service
public class AeronaveService {

    private final AeronaveRepository aeronaveRepository;

    public AeronaveService(AeronaveRepository aeronaveRepository) {
        this.aeronaveRepository = aeronaveRepository;
    }

    public List<Aeronave> listarTodas() {
        return aeronaveRepository.findAll();
    }

    public Optional<Aeronave> obtenerPorId(Long id) {
        return aeronaveRepository.findById(id);
    }

    public List<Aeronave> buscarPorTipo(String tipo) {
        return aeronaveRepository.findByTipo(tipo);
    }

    @Transactional
    public Aeronave actualizar(Long id, Aeronave datos) {
        Aeronave aeronave = aeronaveRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Aeronave no encontrada con id: " + id));

        aeronave.setCodigo(datos.getCodigo());
        aeronave.setNombre(datos.getNombre());
        aeronave.setCapacidad(datos.getCapacidad());
        aeronave.setTipo(datos.getTipo());

        return aeronaveRepository.save(aeronave);
    }

    @Transactional
    public void eliminar(Long id) {
        if (!aeronaveRepository.existsById(id)) {
            throw new RuntimeException("Aeronave no encontrada con id: " + id);
        }
        aeronaveRepository.deleteById(id);
    }
}