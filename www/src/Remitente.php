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
        $this->prepareStatement("SELECT * from remitente order by nombre"); 
        $this->runStatement();
        return $this->fetchAll();
    }


    function borrarCliente($id) {
        $this->prepareStatement("DELETE FROM remitente WHERE id=:id");
        $this->setParam(":id", $id);
        return $this->runStatement();
    }

    function crearRemitente($nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $this->prepareStatement('INSERT INTO remitente (nombre, apellidos, correo, telefono, calle, piso, idPoblacion)
        VALUES (:nombre, :apellidos, :correo, :telefono, :calle, :piso, :idPoblacion)');

        $this->setParam(":nombre", $nombre);
        $this->setParam(":apellidos", $apellidos);
        $this->setParam(":correo", $correo);
        $this->setParam(":telefono", $telefono);
        $this->setParam(":calle", $calle);
        $this->setParam(":piso", $piso);
        $this->setParam(":idPoblacion", $idPoblacion);

        return $this->runStatement();
        
    }

    function actualizarRemitente($id, $nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $this->prepareStatement("UPDATE remitente SET nombre=:nombre, apellidos=:apellidos, correo=:correo
        telefono=:telefono, calle=:calle, piso=:piso, idPoblacion=:idPoblacion WHERE id=:id");

        $this->setParam(":id", $id);
        $this->setParam(":nombre", $nombre);
        $this->setParam(":apellidos", $apellidos);
        $this->setParam(":correo", $correo);
        $this->setParam(":telefono", $telefono);
        $this->setParam(":calle", $calle);
        $this->setParam(":piso", $piso);
        $this->setParam(":idPoblacion", $idPoblacion);
        
        $this->runStatement();
    }

    function getRemitente($id) {
        $this->prepareStatement("SELECT * FROM remitente WHERE id=:id");
        $this->setParam(":id", $id);
        $this->runStatement();
        return $this->fetch();
    }
}