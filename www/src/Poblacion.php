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
        $stmt = $this->prepareStatement("SELECT * from poblacion order by nombre"); 
        $stmt->runStatement();
        return $stmt->fetchAll();
    }

    function borrarPoblacion($id) {
        $stmt = $this->prepareStatement("DELETE FROM poblacion WHERE id=:id");
        $stmt->setParam(":id", $id);
        if (!$this->borrarRepartidorAsignado($id)) {
            return false;
        }
        return $stmt->runStatement();
    }

    function crearPoblacion($nombre, $cp) {
        $stmt = $this->prepareStatement("INSERT INTO poblacion (nombre, cp) VALUES (:nombre, :cp)");
        $stmt->setParam(":nombre", $nombre);
        $stmt->setParam(":cp", $cp);
        return $stmt->runStatement();
    }

    function actualizarPoblacion($id, $nombre, $cp) {
        $stmt = $this->prepareStatement("UPDATE poblacion SET nombre=:nombre, cp=:cp WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->setParam(":nombre", $nombre);
        $stmt->setParam(":cp", $cp);
        return $stmt->runStatement();
    }

    public function borrarRepartidorAsignado($id) {
        $stmt = $this->prepareStatement("DELETE FROM reparpoblacion WHERE idPoblacion=:id");
        $stmt->setParam(":id", $id);
        return $stmt->runStatement();
    }

    function getPoblacion($id) {
        $stmt = $this->prepareStatement("SELECT * from poblacion WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }

    function getAssociatedRepartidor($id) {
        $stmt = $this->prepareStatement("SELECT idRepartidor from reparpoblacion WHERE idPoblacion=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }

    function asignarRepartidor($idPueblo, $idRepartidor) {
        $repartidor = new Repartidor();
        
        $foundRepartidor = $repartidor->getAssociatedPubelo($idRepartidor);
        $foundPueblo = $this->getAssociatedRepartidor($idPueblo);

        if (!!$foundRepartidor || !!$foundPueblo) {
            if ($foundRepartidor != $idRepartidor || $foundPueblo != $idPueblo) {
                return false;
            }
        }

        $stmt = $this->prepareStatement("INSERT INTO reparpoblacion (idRepartidor, idPoblacion) VALUES (:idRepartidor, :idPoblacion)");
        $stmt->setParam(":idRepartidor", $idRepartidor);
        $stmt->setParam(":idPoblacion", $idPueblo);
        return $stmt->runStatement();
    }

    function getColumns() {
        $stmt = $this->prepareStatement("DESCRIBE `poblacion`");
        $stmt->runStatement();
        $found = $stmt->fetchAll();

        foreach ($found as $key => $value) {
            $found[$value["Field"]] = "";
            unset($found[$key]);
        }

        return $found;
    }
}