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
            die("Error al recuperar repartidores: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarRepartidor($id)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM repartidor WHERE id='$id'");
            $stmt->execute();
            echo "<p>EL REPARTIDOR HA SIDO BORRADO</p>";           
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
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
                echo "<p>EL REPARTIDOR SE HA AÑADIDO</p>";
            } catch (PDOException $ex) {
                ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            }
        }
    }
}