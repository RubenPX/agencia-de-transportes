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
        $stmt = $this->prepareStatement("SELECT * from destinatario order by nombre"); 
        $stmt->runStatement();
        return $stmt->fetchAll();
    }

    function borrarDestinatario($id) {
        $stmt = $this->prepareStatement("DELETE FROM destinatario WHERE id=:id");
        $stmt->setParam(":id", $id);
        return $stmt->runStatement();
    }

    function crearDestinatario($nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $stmt = $this->prepareStatement('INSERT INTO destinatario (nombre, apellidos, correo, telefono, calle, piso, idPoblacion)
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

    function actualizarDestinatario($id, $nombre, $apellidos, $correo, $telefono, $calle, $piso, $idPoblacion) {
        $stmt = $this->prepareStatement("UPDATE destinatario SET nombre=:nombre, apellidos=:apellidos, correo=:correo
        telefono=:telefono, calle=:calle, piso=:piso, idPoblacion=:idPoblacion WHERE id=:id");

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

    function getDestinatario($id) {
        $stmt = $this->prepareStatement("SELECT * FROM destinatario WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }
}