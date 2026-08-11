package com.example.SistemaAeropuerto.model;

import jakarta.persistence.*;
import java.util.ArrayList;
import java.util.List;

@Entity
@Table(name = "aerolineas")
public class Aerolinea {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false, unique = true, length = 10)
    private String codigo;          // ejm : "AV", "IB", "AA"

    @Column(nullable = false, length = 100)
    private String nombre;

    @Column(length = 50)
    private String pais;

    @OneToMany(mappedBy = "aerolinea", cascade = CascadeType.ALL, orphanRemoval = true)
    private List<Aeronave> flota = new ArrayList<>();

    // Constructores
    public Aerolinea() {
    }

    public Aerolinea(String codigo, String nombre, String pais) {
        this.codigo = codigo;
        this.nombre = nombre;
        this.pais = pais;
    }

    // Getters y Setters
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getPais() {
        return pais;
    }

    public void setPais(String pais) {
        this.pais = pais;
    }

    public List<Aeronave> getFlota() {
        return flota;
    }

    public void setFlota(List<Aeronave> flota) {
        this.flota = flota;
    }

    // Agregar y eliminar aeronaves de la flota

    public void agregarAeronave(Aeronave aeronave) {
        flota.add(aeronave);
        aeronave.setAerolinea(this);
    }

    public void eliminarAeronave(Aeronave aeronave) {
        flota.remove(aeronave);
        aeronave.setAerolinea(null);
    }
}