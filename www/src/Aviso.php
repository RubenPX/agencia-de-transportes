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
        $this->prepareStatement("SELECT * from aviso order by nombre");
        $this->runStatement();
        return $this->fetchAll();
    }

    function borrarAviso($id) {
        $this->prepareStatement("DELETE FROM remitente WHERE id=:id");
        $this->setParam(":id", $id);
        return $this->runStatement();
    }

    function crearAviso($idEnvio, $fecha, $idRepartidor) {
        $this->prepareStatement('INSERT INTO aviso (idEnvio, fecha, idRepartidor)
            VALUES (:idEnvio, :fecha, :idRepartidor)');
        $this->setParam(":idEnvio", $idEnvio);
        $this->setParam(":fecha", $fecha);
        $this->setParam(":idRepartidor", $idRepartidor);
        return $this->runStatement();
    }

    function actualizarAviso($id, $idEnvio, $fecha, $idRepartidor) {
        $this->prepareStatement("UPDATE remitente SET idEnvio=:idEnvio, fecha=:fecha, idRepartidor=:idRepartidor
                WHERE id=:id");
        $this->setParam(":id", $id);
        $this->setParam(":idEnvio", $idEnvio);
        $this->setParam(":fecha", $fecha);
        $this->setParam(":idRepartidor", $idRepartidor);

        return $this->runStatement();
    }

    function getAviso($id) {
        $this->prepareStatement("SELECT * FROM aviso WHERE id=:id");
        $this->setParam(":id", $id);
        $this->runStatement();
        return $this->fetch();
    }

    function getAvisosByEnvioID($id) {
        $this->prepareStatement("SELECT * FROM aviso WHERE idEnvio=:id");
        $this->setParam(":id", $id);
        $this->runStatement();
        return $this->fetchAll();
    }
}