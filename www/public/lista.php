<?php
require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

use Lista\Lista;

$error = "";
$properties = [];
$title = "Lista de ";

if (!isset($_GET["type"])) {
    $error = "Required parameter: type";
    echo $blade
        ->view()
        ->make('lista', compact("logedUser", "error"))
        ->render();
    die();
}

// Set title
switch ($_GET["type"]) {
    case "Client":
        $title .= "clientes";
        break;
    case "Repartidor":
        $title .= "repartidores";
        break;
    case "Envio":
        $title .= "envios";
        break;
    case "Pueblo":
        $title .= "pueblos";
        break;
    default:
        $title = "Lista no encontrada";
        break;
}

$type = $_GET["type"];
$properties = Lista::handle($type);
if (isset($properties["!ERROR"])) {
    $error = $properties["!ERROR"];
}

echo $blade
    ->view()
    ->make('lista', compact("logedUser", "properties", "title", "type", "error"))
    ->render();

?>