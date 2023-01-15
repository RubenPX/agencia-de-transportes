<?php

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// todo: @RubenPX complete template to use Classes//Envios

use Clases\Envio;

$error = "";
$title = "Envio numero: ";

if (!isset($_GET["id"])) {
    $error = "Se requiere un id de envio";
} else {
    $envio = new Envio();
    $found = $envio->detallesEnvio($_GET["id"]);

    if (!$found) {
        $error = "No se ha encontrado el envio con el id " . $_GET["id"];
        $title = $error;
    } else {
        $properties = $found;
        $title .= $properties["Envio_ID"];
    }
}

echo $blade
    ->view()
    ->make('enviosDetalle', compact("logedUser", "properties", "title"))
    ->render();

?>