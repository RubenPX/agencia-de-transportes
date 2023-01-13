<?php

// unitlity classes
use Clases\Converters;

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
        $_GET["id"] = "1";
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

    if (!isset($_GET["id"]) && $STATE != "CREATE") {
        $error = "Required param: id";
        return [];
    }

    $deleteValues = function ($v) {
        return "";
    };

    // == Get clients from database == //
    if ($_GET["type"] == "Client") {
        $title = $stateTXT . "cliente";
        $cliente = new Cliente();

        $found = $cliente->getCliente($_GET["id"]);

        if (!$found) {
            $error = "Cliente no encontrado";
            return [];
        }

        $properties = Converters::objToArray($found);

        // Remove protected parameter password
        unset($properties["password"]);

        // convert number to boolean
        $properties["activo"] = $properties["activo"] == 1 ? true : false;
    }

    // == Get pueblos from database == //
    if ($_GET["type"] == "Pueblo") {
        $title = $stateTXT . "pueblo";
        $poblacion = new Poblacion();

        $found = $poblacion->getPoblacion($_GET["id"]);

        if (!$found) {
            $error = "Pueblo no encontrado";
            return [];
        }
    }

    // == Get repartidor from database == //
    if ($_GET["type"] == "Repartidor") {
        $title = $stateTXT . "repartidor";
        $repartidor = new Repartidor();

        $found = $repartidor->getRepartidor($_GET["id"]);

        if (!$found) {
            $error = "Repartidor no encontrado";
            return [];
        }
    }

    // == Get repartidores == //
    if ($_GET["type"] == "Envio") {
        $title = $stateTXT . "envio";
        $envio = new Envio();

        $found = $envio->getEnvio($_GET["id"]);

        if (!$found) {
            $error = "Envio no encontrado";
            return [];
        }
    }

    $properties = Converters::objToArray($found);
    return $properties;
}


?>