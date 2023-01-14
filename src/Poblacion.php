<?php

namespace Clases;

use PDO;
use PDOException;

class Poblacion extends Conexion
{
    private $id;
    private $nombre;
    private $cp;

    public function __construct()
    {
        parent::__construct();
    }


    function recuperarPoblaciones()
    {
        $consulta = "select * from poblacion";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar poblaciones: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarPoblacion($id)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM poblacion WHERE id='$id'");
            $stmt->execute();         
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }

        try { //borramos de la tabla reparpoblacion
            $this->borrarRepartidorAsignado($id);
      
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }

        return true;
    }

    function crearPoblacion($nombre, $cp)
    {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO poblacion (nombre, cp) VALUES (:nombre, :cp)");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $cp);
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }

    function actualizarPoblacion($id, $nombre, $cp)
    {
        try {
            $stmt = $this->conexion->prepare("UPDATE poblacion SET nombre=:nombre, cp=:cp WHERE id='$id'");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $cp);
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }

    public function borrarRepartidorAsignado($id)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM reparpoblacion WHERE idPoblacion='$id'");
            $stmt->execute();          
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }

    function getPoblacion($id)
    {
        $consulta = "SELECT
            /* Poblacion */
            `poblacion`.nombre as nombre,
            `poblacion`.cp as cp,
            CONCAT(`repartidor`.Nombre,' ', `repartidor`.Apellidos) as Repartidor
            FROM `poblacion`
            /* mezclamos reparpoblacion */
            INNER JOIN `reparpoblacion` ON `poblacion`.id = `reparpoblacion`.idPoblacion
            /* mezclamos repartidor */
            INNER JOIN `repartidor` ON `reparpoblacion`.`idRepartidor` = `repartidor`.`id` WHERE `poblacion`.id='$id'";
        try {
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar poblacion: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}