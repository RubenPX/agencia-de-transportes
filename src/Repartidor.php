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

}