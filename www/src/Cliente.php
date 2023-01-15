<?php

namespace Clases;

class Cliente extends Conexion {
    private $DNI;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $mail;
    private $password;
    private $activo;

    public function __construct() {
        parent::__construct();
    }

    function recuperarClientes() {
        $this->prepareStatement("SELECT * from cliente order by nombre");
        $this->runStatement();
        return $this->fetchAll();
    }

    function borrarCliente($DNI) {
        $this->prepareStatement("DELETE FROM cliente WHERE DNI=:DNI");
        $this->setParam(":DNI", $DNI);
        return $this->runStatement();
    }

    function crearCliente($DNI, $nombre, $apellidos, $telefono, $mail, $password, $activo) {
        $this->prepareStatement("SELECT DNI FROM cliente WHERE DNI=:DNI");
        $this->setParam(":DNI", $DNI);
        $this->runStatement();

        $consulta = $this->fetch();

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            $this->prepareStatement('INSERT INTO cliente (DNI, nombre, apellidos, telefono, mail, password, activo)
            VALUES (:dni, :nombre, :apellidos, :telefono, :mail, :password, :activo)');

            $this->setParam(":dni", $DNI);
            $this->setParam(":nombre", $nombre);
            $this->setParam(":apellidos", $apellidos);
            $this->setParam(":telefono", $telefono);
            $this->setParam(":mail", $mail);
            $this->setParam(":password", $password);
            $this->setParam(":activo", $activo);

            return $this->runStatement();
        }

        return false;
    }

    function actualizarCliente($DNI, $nombre, $apellidos, $telefono, $mail, $activo) {
        $this->prepareStatement("UPDATE cliente SET nombre=:nombre, apellidos=:apellidos,
        telefono=:telefono, mail=:mail, activo=:activo WHERE DNI=:DNI");
        $this->setParam(":DNI", $DNI);
        $this->setParam(":nombre", $nombre);
        $this->setParam(":apellidos", $apellidos);
        $this->setParam(":telefono", $telefono);
        $this->setParam(":mail", $mail);
        $this->setParam(":activo", $activo);
        return $this->runStatement();
    }

    function getCliente($DNI) {
        $this->prepareStatement("SELECT * FROM cliente WHERE DNI=:DNI");
        $this->setParam(":DNI", $DNI);
        $this->runStatement();
        return $this->fetch();
    }

    function cambiarPassword($DNI, $password) {
        $this->prepareStatement("UPDATE cliente SET password=:password WHERE DNI=:DNI");
        $this->setParam(":DNI", $DNI);
        $this->setParam(":password", $password);
        $this->runStatement();
    }

}