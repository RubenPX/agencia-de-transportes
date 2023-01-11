<?php

namespace Clases;

use PDO;
use PDOException;

class Poblacion extends Conexion
{
    private $id;
    private $nombre;
    private $cp;

    public function __construct()
    {
        parent::__construct();
    }


    function recuperarPoblaciones()
    {
        $consulta = "select * from poblacion";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al recuperar poblaciones: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}