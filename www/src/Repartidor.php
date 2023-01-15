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
        $this->prepareStatement("SELECT r.id, r.DNI, r.Nombre, r.Apellidos, p.idPoblacion 
            FROM repartidor r,  reparpoblacion p
            WHERE r.id=p.idRepartidor");
        $this->runStatement();
        return $this->fetchAll();
    }


    function borrarRepartidor($id) {
        $this->prepareStatement("DELETE FROM repartidor WHERE id=:id");
        $this->setParam(":id", $id);
        $this->borrarPoblacionAsignada($id);
        return $this->runStatement();


    }

    function crearRepartidor($DNI, $Nombre, $Apellidos) {
        $this->prepareStatement("SELECT DNI FROM repartidor WHERE DNI=:DNI");
        $this->setParam(":DNI", $DNI);
        $this->runStatement();

        $consulta = $this->fetch();

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            $this->prepareStatement("INSERT INTO repartidor (DNI, Nombre, Apellidos) VALUES (:dni, :nombre, :apellidos)");

            $this->setParam(":dni", $DNI);
            $this->setParam(":nombre", $Nombre);
            $this->setParam(":apellidos", $Apellidos);
            
            return $this->runStatement();
        }
        return false;
    }

    function actualizarRepartidor($id, $DNI, $Nombre, $Apellidos) {
        $this->prepareStatement("SELECT DNI FROM repartidor WHERE id=:id");
        $this->setParam(":id", $id);
        $this->runStatement();

        $consulta = $this->fetch();

        if ($consulta == null){
            $this->prepareStatement("UPDATE repartidor SET DNI=':DNI', Nombre=:nombre, Apellidos=:apellidos WHERE id=:id");

            $this->setParam(":id", $id);
            $this->setParam(":DNI", $DNI);
            $this->setParam(":nombre", $Nombre);
            $this->setParam(":apellidos", $Apellidos);

            $this->runStatement();
        }
        return false;
    }

    function asignarPoblacion($idRepartidor, $idPoblacion) {
        $this->prepareStatement("INSERT INTO reparpoblacion (idRepartidor, idPoblacion)
        VALUES (:idRepartidor, :idPoblacion)");

        $this->setParam(":idRepartidor", $idRepartidor);
        $this->setParam(":idPoblacion", $idPoblacion);
    
        $this->runStatement();
    }

    function borrarPoblacionAsignada($id) {
        $this->prepareStatement("DELETE FROM reparpoblacion WHERE idRepartidor=:id");
        $this->setParam(":id", $id);
        $this->runStatement();
    }

    function getRepartidor($id) {
        $this->prepareStatement("SELECT
        /* Repartidor */
        `repartidor`.id as idRepartidor,
        `repartidor`.DNI as DNIRepartidor,
        `repartidor`.Nombre as Nombre,
        `repartidor`.Apellidos as Apellidos,
        `poblacion`.nombre as Poblacion
        FROM `repartidor`
        /* mezclamos reparpoblacion */
        INNER JOIN `reparpoblacion` ON `repartidor`.id = `reparpoblacion`.idRepartidor
        /* mezclamos poblacion */
        INNER JOIN `poblacion` ON `reparpoblacion`.`idPoblacion` = `poblacion`.`id` WHERE `repartidor`.id=:idRepartidor");

        $this->setParam(":idRepartidor", $id);

        $this->runStatement();

        return $this->fetch();
    }

}