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
        $this->prepareStatement("SELECT * from destinatario order by nombre"); 
        $this->runStatement();
        return $this->fetchAll();
    }

    function borrarDestinatario($id) {
        $this->prepareStatement("DELETE FROM destinatario WHERE id=:id");
        $this->setParam(":id", $id);
        return $this->runStatement();
    }

    function crearDestinatario($nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $this->prepareStatement('INSERT INTO destinatario (nombre, apellidos, correo, telefono, calle, piso, idPoblacion)
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

    function actualizarDestinatario($id, $nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $this->prepareStatement("UPDATE destinatario SET nombre=:nombre, apellidos=:apellidos, correo=:correo
        telefono=:telefono, calle=:calle, piso=:piso, idPoblacion=:idPoblacion WHERE id=:id");

        $this->setParam(":id", $id);
        $this->setParam(":nombre", $nombre);
        $this->setParam(":apellidos", $apellidos);
        $this->setParam(":correo", $correo);
        $this->setParam(":telefono", $telefono);
        $this->setParam(":calle", $calle);
        $this->setParam(":piso", $piso);
        $this->setParam(":idPoblacion", $idPoblacion);
        
        return $this->runStatement();
    }

    function getDestinatario($id) {
        $this->prepareStatement("SELECT * FROM destinatario WHERE id=:id");
        $this->setParam(":id", $id);
        $this->runStatement();
        return $this->fetch();
    }
}