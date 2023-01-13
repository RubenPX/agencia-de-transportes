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
            return true;           
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
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
            $stmt = $this->conexion->prepare("INSERT INTO poblacion (nombre, cp) VALUES (:nombre, :cp)
                WHERE id='$id'");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $cp);
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }

    function getPoblacion($id)
    {
        $consulta = "select * from poblacion WHERE id='$id'";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar poblacion: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetch();
    }
}