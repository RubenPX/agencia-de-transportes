<?php

namespace Clases;

use PDO;
use PDOException;

class Envio extends Conexion
{
    public $id;
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

    function borrarEnvio($id)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM envio WHERE id='$id'");
            $stmt->execute();
            return true;           
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }

    function crearEnvio($idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $tarifa)
    {
        try {
            $estado = 'entregado';
            $stmt = $this->conexion->prepare("INSERT INTO envio (idDestinatario, idRemitente,
                DNICliente, fecha, peso, ancho, largo, alto, estado, tarifa) VALUES (:idDestinatario, :idRemitente,
                :DNICliente, :fecha, :peso, :ancho, :largo, :alto, :estado, :tarifa)");
            $stmt->bindParam(":idDestinatario", $idDestinatario);
            $stmt->bindParam(":idRemitente", $idRemitente);
            $stmt->bindParam(":DNICliente", $DNICliente);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":peso", $peso);
            $stmt->bindParam(":ancho", $ancho);
            $stmt->bindParam(":largo", $largo);
            $stmt->bindParam(":alto", $alto);
            $stmt->bindParam(":estado", $estado);
            $stmt->bindParam(":tarifa", $tarifa);
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }
    

    function actualizarEnvio($id, $idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $estado, $tarifa)
    {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO envio (idDestinatario, idRemitente,
                DNICliente, fecha, peso, ancho, largo, alto estado, tarifa) VALUES (:idDestinatario, :idRemitente,
                :DNICliente, :fecha, :peso, :ancho, :largo, :alto, :estado, :tarifa) WHERE id=$id");
            $stmt->bindParam(":idDestinatario", $idDestinatario);
            $stmt->bindParam(":idRemitente", $idRemitente);
            $stmt->bindParam(":DNICliente", $DNICliente);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":peso", $peso);
            $stmt->bindParam(":ancho", $ancho);
            $stmt->bindParam(":largo", $largo);
            $stmt->bindParam(":alto", $alto);
            $stmt->bindParam(":estado", $estado);
            $stmt->bindParam(":tarifa", $tarifa);
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
    }
   /*  function buscarEnvio()
    {
        $parametroABuscar = $_POST['queBuscar'];
        $consulta = "select * form envio where $id or $idDestinatario or $idRemitente or 
        $DNICliente or $fecha or $peso or $ancho or $largo or $alto or $estado or $tarifa
        LIKE $parametroABuscar";
        
    } */
}