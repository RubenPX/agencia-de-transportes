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

        $stmt = $this->prepareStatement($consulta);
        $stmt->runStatement();
        return $stmt->fetchAll();
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

        $stmt = $this->prepareStatement($consulta);
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }


    function borrarEnvio($id) {
        $stmt = $this->prepareStatement("DELETE FROM envio WHERE id=:id");
        $stmt->setParam(":id", $id);
        return $stmt->runStatement();
    }

    function crearEnvio($idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $tarifa) {

        $estado = '1'; // recogido
        $stmt = $this->prepareStatement("INSERT INTO envio (idDestinatario, idRemitente,
                DNICliente, fecha, peso, ancho, largo, alto, estado, tarifa) VALUES (:idDestinatario, :idRemitente,
                :DNICliente, :fecha, :peso, :ancho, :largo, :alto, :estado, :tarifa)");
        $stmt->setParam(":idDestinatario", $idDestinatario);
        $stmt->setParam(":idRemitente", $idRemitente);
        $stmt->setParam(":DNICliente", $DNICliente);
        $stmt->setParam(":fecha", $fecha);
        $stmt->setParam(":peso", $peso);
        $stmt->setParam(":ancho", $ancho);
        $stmt->setParam(":largo", $largo);
        $stmt->setParam(":alto", $alto);
        $stmt->setParam(":estado", $estado);
        $stmt->setParam(":tarifa", $tarifa);

        return $stmt->runStatement();
    }


    function actualizarEnvio($id, $idDestinatario, $idRemitente, $DNICliente, $fecha, $peso, $ancho,
        $largo, $alto, $estado, $tarifa) {
        $stmt = $this->prepareStatement("UPDATE envio SET idDestinatario=:idDestinatario, idRemitente=:idRemitente,
                DNICliente=:DNICliente, fecha=:fecha, peso=:peso, ancho=:ancho, largo=:largo, alto=:alto, estado=:estado,
                tarifa=:tarifa WHERE id=$id");

        $stmt->setParam(":idDestinatario", $idDestinatario);
        $stmt->setParam(":idRemitente", $idRemitente);
        $stmt->setParam(":DNICliente", $DNICliente);
        $stmt->setParam(":fecha", $fecha);
        $stmt->setParam(":peso", $peso);
        $stmt->setParam(":ancho", $ancho);
        $stmt->setParam(":largo", $largo);
        $stmt->setParam(":alto", $alto);
        $stmt->setParam(":estado", $estado);
        $stmt->setParam(":tarifa", $tarifa);

        return $stmt->runStatement();
    }

    function getEnvio($id) {
        $stmt = $this->prepareStatement("SELECT * FROM envio WHERE id=:id");
        $stmt->setParam(":id", $id);
        $stmt->runStatement();
        return $stmt->fetch();
    }

    function getEstados() {
        $stmt = $this->prepareStatement("SELECT * FROM estado");
        $stmt->runStatement();
        return $stmt->fetchAll();
    }

    function getColumns() {
        $stmt = $this->prepareStatement("DESCRIBE `envio`");
        $stmt->runStatement();
        $found = $stmt->fetchAll();

        foreach ($found as $key => $value) {
            $found[$value["Field"]] = "";
            unset($found[$key]);
        }

        return $found;
    }

}