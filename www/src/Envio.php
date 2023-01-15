<?php

namespace Clases;

use PDO;
use PDOException;

class Envio extends Conexion {
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

    public function __construct() {
        parent::__construct();
    }

    function recuperarEnvios($keyword = false) {
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

        if ($keyword) {
            $consulta .= "WHERE `envio`.id LIKE '%" . $keyword . "%' ";
            $consulta .= "OR `remitente`.nombre LIKE '%" . $keyword . "%' ";
            $consulta .= "OR `remitente`.apellidos LIKE '%" . $keyword . "%' ";
            $consulta .= "OR `destinatario`.nombre LIKE '%" . $keyword . "%' ";
            $consulta .= "OR `destinatario`.apellidos LIKE '%" . $keyword . "%' ";
            $consulta .= "OR `envio`.fecha LIKE '%" . $keyword . "%' ";
            $consulta .= "OR `estado`.tipo LIKE '%" . $keyword . "%' ";
        }

        $this->prepareStatement($consulta);
        $this->runStatement();
        return $this->fetchAll();
    }

    function detallesEnvio($id) {
        $consulta = "SELECT
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
        
        WHERE `envio`.id = :id";

       
            $this->prepareStatement($consulta);
            $this->setParam(":id", $id);
            $this->runStatement();
            return $this->fetch();
    }


    function borrarEnvio($id) {
        $this->prepareStatement("DELETE FROM envio WHERE id=:id");
        $this->setParam(":id", $id);
        return $this->runStatement();
    }

    function crearEnvio($idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $tarifa) {
        
            $estado = 'entregado';
            $stmt = $this->conexion->prepare("INSERT INTO envio (idDestinatario, idRemitente,
                DNICliente, fecha, peso, ancho, largo, alto, estado, tarifa) VALUES (:idDestinatario, :idRemitente,
                :DNICliente, :fecha, :peso, :ancho, :largo, :alto, :estado, :tarifa)");
            $this->setParam(":idDestinatario", $idDestinatario);
            $this->setParam(":idRemitente", $idRemitente);
            $this->setParam(":DNICliente", $DNICliente);
            $this->setParam(":fecha", $fecha);
            $this->setParam(":peso", $peso);
            $this->setParam(":ancho", $ancho);
            $this->setParam(":largo", $largo);
            $this->setParam(":alto", $alto);
            $this->setParam(":estado", $estado);
            $this->setParam(":tarifa", $tarifa);
        
            $this->runStatement();
    }


    function actualizarEnvio($id, $idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $estado, $tarifa) {
            $this->prepareStatement("UPDATE envio SET idDestinatario=:idDestinatario, idRemitente=:idRemitente,
                DNICliente=:DNICliente, fecha=:fecha, peso=:peso, ancho=:ancho, largo=:largo, alto=:alto estado=:estado,
                tarifa=:tarifa WHERE id=$id");
                
            $this->setParam(":idDestinatario", $idDestinatario);
            $this->setParam(":idRemitente", $idRemitente);
            $this->setParam(":DNICliente", $DNICliente);
            $this->setParam(":fecha", $fecha);
            $this->setParam(":peso", $peso);
            $this->setParam(":ancho", $ancho);
            $this->setParam(":largo", $largo);
            $this->setParam(":alto", $alto);
            $this->setParam(":estado", $estado);
            $this->setParam(":tarifa", $tarifa);

            $this->runStatement();
    }

    function getEnvio($id) {
        $this->prepareStatement("SELECT * FROM envio WHERE id=:id");
        $this->setParam(":id", $id);
        $this->runStatement();
        return $this->fetch();
    }

    function getEstados() {
        $this->prepareStatement("SELECT * FROM estado");
        $this->runStatement();
        return $this->fetchAll();
    }

}