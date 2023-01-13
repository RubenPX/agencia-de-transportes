<?php

namespace Clases;

use PDO;
use PDOException;

class Repartidor extends Conexion
{
    private $id;
    private $DNI;
    private $Nombre;
    private $Apellidos;
    private $idPoblacion;


    public function __construct()
    {
        parent::__construct();
    }


    function recuperarRepartidores()
    {
        $consulta = "SELECT r.id, r.DNI, r.Nombre, r.Apellidos, p.idPoblacion 
            FROM repartidor r,  reparpoblacion p
            WHERE r.id=p.idRepartidor";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar repartidores: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarRepartidor($id)
    {
        try { //borramos de la tabla repartidor
            $stmt = $this->conexion->prepare("DELETE FROM repartidor WHERE id='$id'");
            $stmt->execute();
            return true;           
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }

    
    }

    function crearRepartidor($DNI, $Nombre, $Apellidos)
    {
        try {
            $resultadoConsulta = $this->conexion->query("SELECT DNI FROM repartidor WHERE DNI='$DNI'");
            $consulta = $resultadoConsulta->fetch();
        } catch (PDOException $ex) {
            ("Error en la consulta, mensaje de error:  " . $ex->getMessage());
        }

        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            try {
                $stmt = $this->conexion->prepare("INSERT INTO repartidor (DNI, Nombre, Apellidos) VALUES (:dni, :nombre, :apellidos)");
                $stmt->bindParam(":dni", $DNI);
                $stmt->bindParam(":nombre", $Nombre);
                $stmt->bindParam(":apellidos", $Apellidos);
                $stmt->execute();
                return true;
            } catch (PDOException $ex) {
                ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
                return false;
            }
        }
    }

    function actualizarRepartidor($id, $DNI, $Nombre, $Apellidos)
    {
        try {  //Comprobamos DNI ya que no es UNIQUE
            $resultadoConsulta = $this->conexion->query("SELECT DNI FROM repartidor WHERE DNI='$DNI'");
            $consulta = $resultadoConsulta->fetch();
        } catch (PDOException $ex) {
            ("Error en la consulta, mensaje de error:  " . $ex->getMessage());
        }
        if ($consulta == null) { //En caso de que no haya coincidencia en el campo DNI de ningún registro
            try {
                $stmt = $this->conexion->prepare("INSERT INTO repartidor (DNI, Nombre, Apellidos) VALUES (:DNI, :nombre, :apellidos)
                    WHERE id='$id'");
                $stmt->bindParam(":DNI", $DNI);    
                $stmt->bindParam(":nombre", $Nombre);
                $stmt->bindParam(":apellidos", $Apellidos);
                $stmt->execute();
                return true;
            } catch (PDOException $ex) {
                ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
                return false;
            }
        }
    }

    function asignarPoblacion($id)
    {

    }

    function borrarPoblacionAsignada($id)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM reparpoblacion WHERE idRepartidor='$id'");
            $stmt->execute();
            return true;           
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }
}