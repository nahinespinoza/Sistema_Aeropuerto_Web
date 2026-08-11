package com.example.SistemaAeropuerto.model;

import jakarta.persistence.*;

@Entity
@Table(name = "vuelos")
public class Vuelo {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false, length = 20)
    private String numeroVuelo;     // ejm: "AV123"

    @Column(nullable = false, length = 50)
    private String aerolinea;      

    @Column(nullable = false)
    private Double distancia;       // En km

    @ManyToOne
    @JoinColumn(name = "origen_id", nullable = false)
    private Aeropuerto origen;

    @ManyToOne
    @JoinColumn(name = "destino_id", nullable = false)
    private Aeropuerto destino;

    // Constructores
    public Vuelo() {
    }

    public Vuelo(String numeroVuelo, String aerolinea, Double distancia, Aeropuerto origen, Aeropuerto destino) {
        this.numeroVuelo = numeroVuelo;
        this.aerolinea = aerolinea;
        this.distancia = distancia;
        this.origen = origen;
        this.destino = destino;
    }

    // Getters y Setters
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getNumeroVuelo() {
        return numeroVuelo;
    }

    public void setNumeroVuelo(String numeroVuelo) {
        this.numeroVuelo = numeroVuelo;
    }

    public String getAerolinea() {
        return aerolinea;
    }

    public void setAerolinea(String aerolinea) {
        this.aerolinea = aerolinea;
    }

    public Double getDistancia() {
        return distancia;
    }

    public void setDistancia(Double distancia) {
        this.distancia = distancia;
    }

    public Aeropuerto getOrigen() {
        return origen;
    }

    public void setOrigen(Aeropuerto origen) {
        this.origen = origen;
    }

    public Aeropuerto getDestino() {
        return destino;
    }

    public void setDestino(Aeropuerto destino) {
        this.destino = destino;
    }

    @Override
    public String toString() {
        return numeroVuelo;
    }
}