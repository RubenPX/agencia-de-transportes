<?php

namespace Clases;

use PDO;
use PDOException;

class Cliente extends Conexion
{
    private $DNI;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $mail;
    private $password;
    private $activo;

    public function __construct()
    {
        parent::__construct();
    }


    function recuperarClientes()
    {
        $consulta = "select * from cliente order by nombre";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar clientes: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarCliente($DNI)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM cliente WHERE DNI='$DNI'");
            $stmt->execute();
            return true;           
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }

    function crearCliente($DNI, $nombre, $apellidos, $telefono, $mail, $password, $activo)
    {
        try {
            $resultadoConsulta = $this->conexion->query("SELECT DNI FROM cliente WHERE DNI='$DNI'");
            $consulta = $resultadoConsulta->fetch();
        } catch (PDOException $ex) {
            ("Error en la consulta, mensaje de error:  " . $ex->getMessage());
        }

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            try {
                $stmt = $this->conexion->prepare('INSERT INTO cliente (DNI, nombre, apellidos, telefono, mail, password, activo)
                    VALUES (:dni, :nombre, :apellidos, :telefono, :mail, :password, :activo)');
                $stmt->bindParam(":dni", $DNI);
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":apellidos", $apellidos);
                $stmt->bindParam(":telefono", $telefono);
                $stmt->bindParam(":mail", $mail);
                $stmt->bindParam(":password", $password);
                $stmt->bindParam(":activo", $activo);
                $stmt->execute();
                return true;
            } catch (PDOException $ex) {
                ("Error al crear, mensaje de error:  " . $ex->getMessage());
                return false;
            }
        }
    }

    function actualizarCliente($DNI, $nombre, $apellidos, $telefono, $mail, $password, $activo)
    {
        try {
            $stmt = $this->conexion->prepare("UPDATE cliente SET nombre=:nombre, apellidos=:apellidos,
            telefono=:telefono, mail=:mail, password=:password, activo=:activo WHERE DNI='$DNI'");
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":mail", $mail);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":activo", $activo);
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            ("Error al crear, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }

    function getCliente($DNI)
    {
        $consulta = "select * from cliente WHERE DNI='$DNI'";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar cliente: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}