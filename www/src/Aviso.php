<?php

namespace Clases;

use PDO;
use PDOException;

class Aviso extends Conexion {
    private $id;
    private $idEnvio;
    private $fecha;
    private $idRepartidor;


    public function __construct() {
        parent::__construct();
    }

    function recuperarAvisos() {
        $consulta = "select * from aviso";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar avisoss: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarAviso($id) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM aviso WHERE id='$id'");
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }

        return true;
    }

    function crearAviso($idEnvio, $fecha, $idRepartidor) {
    
        try {
            $stmt = $this->conexion->prepare('INSERT INTO aviso (idEnvio, fecha, idRepartidor)
                VALUES (:idEnvio, :fecha, :idRepartidor)');
            $stmt->bindParam(":idEnvio", $idEnvio);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":idRepartidor", $idRepartidor);
            $stmt->execute();

        } catch (PDOException $ex) {
            ("Error al crear, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }

    function actualizarAviso($id, $idEnvio, $fecha, $idRepartidor) {
        try {
            $stmt = $this->conexion->prepare("UPDATE remitente SET idEnvio=:idEnvio, fecha=:fecha, idRepartidor=:idRepartidor
                WHERE id='$id'");
            $stmt->bindParam(":idEnvio", $idEnvio);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":idRepartidor", $idRepartidor);
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al crear, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }

    function getAviso($id) {
        $consulta = "select * from aviso WHERE id='$id'";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar aviso: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}