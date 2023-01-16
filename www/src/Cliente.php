<?php

namespace Clases;
use PDO;

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
        $stmt = $this->prepareStatement("SELECT activo FROM cliente WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->runStatement();

        $consulta = $stmt->fetch();

        if ($consulta["activo"] == 0) {
            $stmt2 = $this->prepareStatement("DELETE FROM cliente WHERE DNI=:DNI");
            $stmt2->setParam(":DNI", $DNI);
            return $stmt2->runStatement();
        }
        return false;
    }

    function crearCliente($DNI, $nombre, $apellidos, $telefono, $mail, $password) {
        $stmt = $this->prepareStatement("SELECT DNI FROM cliente WHERE DNI=:DNI");
        $stmt->setParam(":DNI", $DNI);
        $stmt->runStatement();

        $consulta = $stmt->fetch();

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            $activo = 1;
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

    function actualizarCliente($from, $DNI, $nombre, $apellidos, $telefono, $mail, $activo) {
        $stmt = $this->prepareStatement("UPDATE cliente SET DNI=:DNI, nombre=:nombre, apellidos=:apellidos,
        telefono=:telefono, mail=:mail, activo=:activo WHERE DNI=:DNIFrom");
        $stmt->setParam(":DNI", $DNI);
        $stmt->setParam(":DNIFrom", $from);
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

    function getColumns() {
        $stmt = $this->prepareStatement("DESCRIBE `cliente`");
        $stmt->runStatement();
        $found = $stmt->fetchAll();

        foreach ($found as $key => $value) {
            $found[$value["Field"]] = "";
            unset($found[$key]);
        }

        return $found;
    }

}