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
            die("Error al recuperar clientes: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}