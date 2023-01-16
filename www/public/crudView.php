<?php
use Crud\CRUD;

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// Initialize variables
$error = "";
$title = "Ver ";
$properties = [];

// Load state
$STATE = "VIEW";
$crud = new CRUD();
$properties = $crud->handle($_GET["type"], $STATE, ["GET_ID" => $_GET["id"]]);

// Detect if has error
if (isset($properties["!ERROR"])) {
    $error = $properties["!ERROR"];
}

// Set title
switch ($_GET["type"]) {
    case "Client":
        $title .= "cliente";
        break;
    case "Repartidor":
        $title .= "repartidor";
        break;
    case "Envio":
        $title .= "envio";
        break;
    case "Pueblo":
        $title .= "población";
        break;
    default:
        $title = "Tipo desconocido";
        break;
}
$type = $_GET["type"];

$id = $_GET["id"];

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "STATE", "type", "title", "error", "id"))
    ->render();

?>