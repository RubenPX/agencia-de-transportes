<?php

namespace Clases;

use PDO;
use PDOException;

class Envio extends Conexion
{
    private $id;
    private $idDestinatario;
    private $idRemitente;
    private $DNICliente;
    private $fecha;
    private $peso;
    private $ancho;
    private $largo;
    private $alto;
    private $estado;
    private $tarifa;

    public function __construct()
    {
        parent::__construct();
    }


    function recuperarEnvios()
    {
        $consulta = "select * from envio";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al recuperar envios: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function buscarEnvio()
    {
        $resultado = $this->crearConexion();
        $consulta = $resultado->fetch();
        $parametroABuscar = $_POST['queBuscar'];
    }
}