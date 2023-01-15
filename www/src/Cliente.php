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
        $stmt = $this->prepareStatement("SELECT * from cliente order by nombre");
        $stmt->runStatement();
        return $stmt->fetchAll();
    }

    function borrarCliente($DNI) {
        $stmt = $this->prepareStatement("DELETE FROM cliente WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        return $stmt->runStatement();
    }

    function crearCliente($DNI, $nombre, $apellidos, $telefono, $mail, $password, $activo) {
        $stmt = $this->prepareStatement("SELECT DNI FROM cliente WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->runStatement();

        $consulta = $stmt->fetch();

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            $stmt2 = $this->prepareStatement('INSERT INTO cliente (DNI, nombre, apellidos, telefono, mail, password, activo)
            VALUES (:dni, :nombre, :apellidos, :telefono, :mail, :password, :activo)');

            $stmt2->setParam(":dni", $DNI);
            $stmt2->setParam(":nombre", $nombre);
            $stmt2->setParam(":apellidos", $apellidos);
            $stmt2->setParam(":telefono", $telefono);
            $stmt2->setParam(":mail", $mail);
            $stmt2->setParam(":password", $password);
            $stmt2->setParam(":activo", $activo);

            return $stmt2->runStatement();
        }

        return false;
    }

    function actualizarCliente($DNI, $nombre, $apellidos, $telefono, $mail, $activo) {
        $stmt = $this->prepareStatement("UPDATE cliente SET nombre=:nombre, apellidos=:apellidos,
        telefono=:telefono, mail=:mail, activo=:activo WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->setParam(":nombre", $nombre);
        $stmt->setParam(":apellidos", $apellidos);
        $stmt->setParam(":telefono", $telefono);
        $stmt->setParam(":mail", $mail);
        $stmt->setParam(":activo", $activo);
        return $stmt->runStatement();
    }

    function getCliente($DNI) {
        $stmt = $this->prepareStatement("SELECT * FROM cliente WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->runStatement();
        return $stmt->fetch();
    }

    function cambiarPassword($DNI, $password) {
        $stmt = $this->prepareStatement("UPDATE cliente SET password=:password WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->setParam(":password", $password);
        $stmt->runStatement();
    }

}