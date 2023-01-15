<?php

namespace Clases;

use PDO;
use PDOException;

class Remitente extends Conexion {
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


    function recuperarRemitentes() {
        $stmt = $this->prepareStatement("SELECT * from remitente order by nombre"); 
        $stmt->runStatement();
        return $stmt->fetchAll();
    }


    function borrarRemitente($id) {
        $stmt = $this->prepareStatement("DELETE FROM remitente WHERE id=:id");
        $stmt->setParam(":id", $id);
        return $stmt->runStatement();
    }

    function crearRemitente($nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $stmt = $this->prepareStatement('INSERT INTO remitente (nombre, apellidos, correo, telefono, calle, piso, idPoblacion)
        VALUES (:nombre, :apellidos, :correo, :telefono, :calle, :piso, :idPoblacion)');

        $stmt->setParam(":nombre", $nombre);
        $stmt->setParam(":apellidos", $apellidos);
        $stmt->setParam(":correo", $correo);
        $stmt->setParam(":telefono", $telefono);
        $stmt->setParam(":calle", $calle);
        $stmt->setParam(":piso", $piso);
        $stmt->setParam(":idPoblacion", $idPoblacion);

        return $stmt->runStatement();
        
    }

    function actualizarRemitente($id, $nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $stmt = $this->prepareStatement("UPDATE remitente 
        SET nombre=:nombre, apellidos=:apellidos, correo=:correo telefono=:telefono, calle=:calle, piso=:piso, idPoblacion=:idPoblacion 
        WHERE id=:id");

        $stmt->setParam(":id", $id);
        $stmt->setParam(":nombre", $nombre);
        $stmt->setParam(":apellidos", $apellidos);
        $stmt->setParam(":correo", $correo);
        $stmt->setParam(":telefono", $telefono);
        $stmt->setParam(":calle", $calle);
        $stmt->setParam(":piso", $piso);
        $stmt->setParam(":idPoblacion", $idPoblacion);
        
        return $stmt->runStatement();
    }

    function getRemitente($id) {
        $stmt = $this->prepareStatement("SELECT * FROM remitente WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }
}