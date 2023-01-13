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
        $consulta = "SELECT
        /* Envio */
        `envio`.id as Envio_ID,
        /* Remitente */
        CONCAT(`remitente`.nombre,' ', `remitente`.apellidos) as Remitente,
        /* Destinatario */
        CONCAT(`destinatario`.nombre,' ', `destinatario`.apellidos) as Destinatario,
        /* Fecha */
        `envio`.fecha as Envio_Fecha,
        /* Estado */
        `estado`.tipo as Estado
        /* FROM */
        FROM `envio`
        /* mezclamos el destinatario */
        INNER JOIN `destinatario` ON `envio`.idDestinatario = `destinatario`.id
        /* mezclamos el remitente */
        INNER JOIN `remitente` ON `envio`.`idRemitente` = `remitente`.`id`
        /* Mezclamos el estado de envio */
        INNER JOIN `estado` ON `envio`.estado = `estado`.id";

        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar envios: " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function detallesEnvio($id)
    {
        try {
            $envio = $this->conexion->runQuery("SELECT
                /* Envio */
                `envio`.id as Envio_ID,
                `envio`.fecha as Envio_Fecha,
                `envio`.peso as Envio_Peso,
                `envio`.ancho as Envio_Ancho,
                `envio`.largo as Envio_Largo,
                `envio`.alto as Envio_Alto,
                `envio`.tarifa as Envio_Tarifa,
                
                /* Remitente */
                `remitente`.nombre as Re_Nombre, 
                `remitente`.apellidos as Re_Apellidos,
                `remitente`.correo as Re_Correo,
                `remitente`.telefono as Re_Telefono,
                `remitente`.calle as Re_Calle,
                `Re_Pob`.nombre as Re_Ciudad,
                `Re_Pob`.cp as Re_CP,
                
                /* Destinatario */
                `destinatario`.nombre as Dest_Nombre, 
                `destinatario`.apellidos as Dest_Apellidos,
                `destinatario`.correo as Dest_Correo,
                `destinatario`.telefono as Dest_Telefono,
                `destinatario`.calle as Dest_Calle,
                `Dest_Pob`.nombre as Dest_Ciudad,
                `Dest_Pob`.cp as Dest_CP,

                /* Cliente */
                `cliente`.DNI as Cli_DNI,
                `cliente`.nombre as Cli_Nombre,
                `cliente`.apellidos as Cli_Apellidos,
                `cliente`.telefono as Cli_Telefono,
                `cliente`.mail as Cli_Mail,
                `cliente`.activo as Cli_Activo,
                
                /* Estado */
                `estado`.tipo as Estado_Tipo

                /* FROM */
                FROM `envio`
                
                /* mezclamos el destinatario */
                INNER JOIN `destinatario` ON `envio`.idDestinatario = `destinatario`.id
                
                /* mezclamos el remitente */
                INNER JOIN `remitente` ON `envio`.`idRemitente` = `remitente`.`id`
                
                /* Mezclamos el estado de envio */
                INNER JOIN `estado` ON `envio`.estado = `estado`.id

                /* Mezclamos las poblaciones */
                INNER JOIN poblacion as Re_Pob ON `Re_Pob`.`id` = `destinatario`.`idPoblacion`
                INNER JOIN poblacion as Dest_Pob ON `Dest_Pob`.`id` = `remitente`.`idPoblacion`

                /* Mezclamos el cliente */
                INNER JOIN cliente ON `cliente`.`DNI` = `envio`.DNICliente
                
                WHERE `envio`.id = " . $_GET["id"]);
            
        }catch (PDOException $ex) {
            ("Error al recuperar detalles de envío: " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return $envio;
    }
   

    function borrarEnvio($id)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM envio WHERE id='$id'");
            $stmt->execute();         
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
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
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }
    

    function actualizarEnvio($id, $idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $estado, $tarifa)
    {
        try {
            $stmt = $this->conexion->prepare("UPDATE envio SET idDestinatario=:idDestinatario, idRemitente=:idRemitente,
                DNICliente=:DNICliente, fecha=:fecha, peso=:peso, ancho=:ancho, largo=:largo, alto=:alto estado=:estado,
                tarifa=:tarifa WHERE id=$id");
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
        } catch (PDOException $ex) {
            ("Error en el borrado, mensaje de error:  " . $ex->getMessage());
            return false;
        }
        $this->conexion = null;
        return true;
    }

    function getEnvio($id)
    {
        $consulta = "select * from envio WHERE id='$id'";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            ("Error al recuperar envío: " . $ex->getMessage());
        }
        $this->conexion = null;
        return $stmt->fetch();
    }

   /*  function buscarEnvio()
    {
        $parametroABuscar = $_POST['queBuscar'];
        $consulta = "select * form envio where $id or $idDestinatario or $idRemitente or 
        $DNICliente or $fecha or $peso or $ancho or $largo or $alto or $estado or $tarifa
        LIKE $parametroABuscar";
        
    } */
}