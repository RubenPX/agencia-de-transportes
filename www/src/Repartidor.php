<?php

namespace Clases;

use PDO;
use PDOException;

class Repartidor extends Conexion {
    private $id;
    private $DNI;
    private $Nombre;
    private $Apellidos;
    private $idPoblacion;


    public function __construct() {
        parent::__construct();
    }

    function recuperarRepartidores() {
        $stmt = $this->prepareStatement("SELECT r.id, r.DNI, r.Nombre, r.Apellidos, p.idPoblacion 
            FROM repartidor r,  reparpoblacion p
            WHERE r.id=p.idRepartidor");
        $stmt->runStatement();
        return $stmt->fetchAll();
    }

    function borrarRepartidor($id) {
        $stmt = $this->prepareStatement("DELETE FROM repartidor WHERE id=:id");
        $stmt->setParam(":id", $id);
        if (!$this->borrarPoblacionAsignada($id)) {
            return false;
        }
        return $stmt->runStatement();
    }

    function crearRepartidor($DNI, $Nombre, $Apellidos) {
        $stmt = $this->prepareStatement("SELECT DNI FROM repartidor WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->runStatement();

        $consulta = $stmt->fetch();

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            $stmt = $this->prepareStatement("INSERT INTO repartidor (DNI, Nombre, Apellidos) VALUES (:dni, :nombre, :apellidos)");

            $stmt->setParam(":dni", $DNI);
            $stmt->setParam(":nombre", $Nombre);
            $stmt->setParam(":apellidos", $Apellidos);
            
            return $stmt->runStatement();
        }

        return false;
    }

    function actualizarRepartidor($id, $DNI, $Nombre, $Apellidos) {
        $stmt = $this->prepareStatement("SELECT DNI FROM repartidor WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();

        $consulta = $stmt->fetch();

        if ($consulta == null){
            $stmt2 = $this->prepareStatement("UPDATE repartidor SET DNI=':DNI', Nombre=:nombre, Apellidos=:apellidos WHERE id=:id");

            $stmt2->setParam(":id", $id);
            $stmt2->setParam(":DNI", $DNI);
            $stmt2->setParam(":nombre", $Nombre);
            $stmt2->setParam(":apellidos", $Apellidos);

            $stmt2->runStatement();
        }

        return false;
    }

    function asignarPoblacion($idRepartidor, $idPoblacion) {
        $stmt = $this->prepareStatement("INSERT INTO reparpoblacion (idRepartidor, idPoblacion)
        VALUES (:idRepartidor, :idPoblacion)");

        $stmt->setParam(":idRepartidor", $idRepartidor);
        $stmt->setParam(":idPoblacion", $idPoblacion);
    
        return $stmt->runStatement();
    }

    function borrarPoblacionAsignada($id) {
        $stmt = $this->prepareStatement("DELETE FROM reparpoblacion WHERE idRepartidor=:id");
        $stmt->setParam(":id", $id);
        return $stmt->runStatement();
    }

    function getRepartidor($id) {
        $stmt = $this->prepareStatement("SELECT * FROM repartidor WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }

    function getAssociatedPubelo($id) {
        $stmt = $this->prepareStatement("SELECT idPoblacion FROM reparpoblacion WHERE idRepartidor=:idRepartidor");
        $stmt->setParam(":idRepartidor", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }

}