<?php

namespace Clases;

use PDO;
use PDOException;

class Poblacion extends Conexion {
    private $id;
    private $nombre;
    private $cp;

    public function __construct() {
        parent::__construct();
    }


    function recuperarPoblaciones() {
        $this->prepareStatement("SELECT * from poblacion order by nombre"); 
        $this->runStatement();
        return $this->fetchAll();
    }

    function borrarPoblacion($id) {
        $this->prepareStatement("DELETE FROM poblacion WHERE id=:id");
        $this->setParam(":id", $id);
        $this->borrarRepartidorAsignado($id);
        return $this->runStatement();

    }

    function crearPoblacion($nombre, $cp) {
        $this->prepareStatement("INSERT INTO poblacion (nombre, cp) VALUES (:nombre, :cp)");
        $this->setParam(":nombre", $nombre);
        $this->setParam(":apellidos", $cp);
      
        return $this->runStatement();
    }

    function actualizarPoblacion($id, $nombre, $cp) {
        $this->prepareStatement("UPDATE poblacion SET nombre=:nombre, cp=:cp WHERE id=:id");
        $this->setParam(":nombre", $nombre);
        $this->setParam(":apellidos", $cp);
        
        $this->runStatement();
    }

    public function borrarRepartidorAsignado($id) {
        $this->prepareStatement("DELETE FROM reparpoblacion WHERE idPoblacion=:id");
        $this->setParam(":id", $id);
        
        $this->runStatement();
    }

    function getPoblacion($id) {
        $this->prepareStatement("SELECT
            /* Poblacion */
            `poblacion`.nombre as nombre,
            `poblacion`.cp as cp,
            CONCAT(`repartidor`.Nombre,' ', `repartidor`.Apellidos) as Repartidor
            FROM `poblacion`
            /* mezclamos reparpoblacion */
            INNER JOIN `reparpoblacion` ON `poblacion`.id = `reparpoblacion`.idPoblacion
            /* mezclamos repartidor */
            INNER JOIN `repartidor` ON `reparpoblacion`.`idRepartidor` = `repartidor`.`id` WHERE `poblacion`.id=:id");
        
        $this->setParam(":id", $id);
        return $this->fetch();

    }
}