<?php

namespace Clases;

use PDO;
use PDOException;

class Destinatario extends Conexion {
    private $id;
    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $calle;
    private $piso;
    private $idPoblacion;

    public function __construct() {
        parent::__construct();
    }


    function recuperarDestinatarios() {
        $consulta = "select * from destinatario";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar destinatarios: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarDestinatario($id) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM destinatario WHERE id='$id'");
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }

        return true;
    }

    function crearDestinatario($nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
    
            try {
                $stmt = $this->conexion->prepare('INSERT INTO destinatario (nombre, apellidos, correo, telefono, calle, piso, idPoblacion)
                    VALUES (:nombre, :apellidos, :correo, :telefono, :calle, :piso, :idPoblacion)');
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":apellidos", $apellidos);
                $stmt->bindParam(":correo", $correo);
                $stmt->bindParam(":telefono", $telefono);
                $stmt->bindParam(":calle", $calle);
                $stmt->bindParam(":piso", $piso);
                $stmt->bindParam(":idPoblacion", $idPoblacion);
                $stmt->execute();

            } catch (PDOException $ex) {
                ("Error al crear, mensaje de error:  " . $ex->getMessage());
                return false;
            }
            $this->conexion = null;
            return true;
        
    }

    function actualizarDestinatario($id, $nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        try {
            $stmt = $this->conexion->prepare("UPDATE destinatario SET nombre=:nombre, apellidos=:apellidos, correo=:correo
            telefono=:telefono, calle=:calle, piso=:piso, idPoblacion=:idPoblacion WHERE id='$id'");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":calle", $calle);
            $stmt->bindParam(":piso", $piso);
            $stmt->bindParam(":idPoblacion", $idPoblacion);
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al crear, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }

    function getDestinatario($id) {
        $consulta = "select * from destinatario WHERE id='$id'";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar destinatario: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}