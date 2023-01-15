<?php

namespace Clases;

class Aviso extends Conexion {
    private $id;
    private $idEnvio;
    private $fecha;
    private $idRepartidor;


    public function __construct() {
        parent::__construct();
    }

    function recuperarAvisos() {
        $stmt = $this->prepareStatement("SELECT * from aviso order by nombre");
        $stmt->runStatement();
        return $stmt->fetchAll();
    }

    function borrarAviso($id) {
        $stmt = $this->prepareStatement("DELETE FROM remitente WHERE id=:id");
        $stmt->setParam(":id", $id);
        return $stmt->runStatement();
    }

    function crearAviso($idEnvio, $fecha, $idRepartidor) {
        $stmt = $this->prepareStatement('INSERT INTO aviso (idEnvio, fecha, idRepartidor) VALUES (:idEnvio, :fecha, :idRepartidor)');
        $stmt->setParam(":idEnvio", $idEnvio);
        $stmt->setParam(":fecha", $fecha);
        $stmt->setParam(":idRepartidor", $idRepartidor);
        return $stmt->runStatement();
    }

    function actualizarAviso($id, $idEnvio, $fecha, $idRepartidor) {
        $stmt = $this->prepareStatement("UPDATE remitente SET idEnvio=:idEnvio, fecha=:fecha, idRepartidor=:idRepartidor WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->setParam(":idEnvio", $idEnvio);
        $stmt->setParam(":fecha", $fecha);
        $stmt->setParam(":idRepartidor", $idRepartidor);
        return $stmt->runStatement();
    }

    function getAviso($id) {
        $stmt = $this->prepareStatement("SELECT * FROM aviso WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }

    function getAvisosByEnvioID($id) {
        $stmt = $this->prepareStatement("SELECT * FROM aviso WHERE idEnvio=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetchAll();
    }
}