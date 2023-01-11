<?php

// unitlity classes
use Clases\QueryParser;

// Database clases
use Clases\Cliente;
use Clases\Poblacion;
use Clases\Repartidor;
use Clases\Envio;

// Examples
// Ver pueblo: http://localhost/crudView.php?type=Pueblo&ID=1
// Ver cliente: http://localhost/crudView.php?type=Client&Client=98765432A

function crudHandler()
{
    global $title, $STATE, $error;

    // Set state text
    $stateTXT = "";
    if ($STATE == "CREATE") {
        $stateTXT = "Crear ";
    } elseif ($STATE == "DELETE") {
        $stateTXT = "Eliminar ";
    } elseif ($STATE == "EDIT") {
        $stateTXT = "Editar ";
    } elseif ($STATE == "READ") {
        $stateTXT = "Ver ";
    }

    if (!isset($_GET["type"])) {
        $error = "Required param: type";
        return [];
    }

    if (!isset($_GET["id"])) {
        $error = "Required param: id";
        return [];
    }

    // == Get clients from database == //
    if ($_GET["type"] == "Client") {
        $title = $stateTXT . "cliente";
        $cliente = new Cliente();

        // todo: @RubenPX Refactor using recuperarCliente with parameter $_GET["id"]
        $found = $cliente->recuperarClientes();

        if (count($found) == 0) {
            $error = "Pueblo no encontrado";
            return [];
        }

        $properties = QueryParser::objToArray($found[0]);

        // Remove protected parameter password
        unset($properties["password"]);

        // convert number to boolean
        $properties["activo"] = $properties["activo"] == 1 ? true : false;
    }

    // == Get pueblos from database == //
    if ($_GET["type"] == "Pueblo") {
        $title = $stateTXT . "pueblo";
        $poblacion = new Poblacion();

        // todo: @RubenPX Refactor using recuperarPoblacion with parameter $_GET["id"]
        $found = $poblacion->recuperarPoblaciones();

        if (count($found) == 0) {
            $error = "Pueblo no encontrado";
            return [];
        }

        $properties = QueryParser::objToArray($found[0]);
    }

    // == Get repartidor from database == //
    if ($_GET["type"] == "Repartidor") {
        $title = $stateTXT . "repartidor";
        $repartidor = new Repartidor();

        // todo: @RubenPX Refactor using recuperarRepartidor with parameter $_GET["id"]
        $found = $repartidor->recuperarRepartidores();

        if (count($found) == 0) {
            $error = "Repartidor no encontrado";
            return [];
        }

        $properties = QueryParser::objToArray($found[0]);
    }

    // == Get repartidores == //
    if ($_GET["type"] == "Envio") {
        $title = $stateTXT . "envio";
        $envio = new Envio();

        // todo: @RubenPX Refactor using recuperarRepartidor with parameter $_GET["id"]
        $found = $envio->recuperarEnvios();

        if (count($found) == 0) {
            $error = "Envio no encontrado";
            return [];
        }

        $properties = QueryParser::objToArray($found[0]);
    }

    return $properties;
}


?>