<?php
use Crud\CRUD;

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// Initialize variables
$error = "";
$title = "Eliminar ";
$properties = [];

// Load state
$STATE = "DELETE";
$crud = new CRUD();

if (isset($_POST["DELETE"])) {
    $properties = $crud->handle($_GET["type"], $STATE, ["DELETE_ID" => $_GET["id"]]);
} else {
    $properties = $crud->handle($_GET["type"], $STATE, ["GET_ID" => $_GET["id"]]);
}



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
        $title .= "pueblo";
        break;
    default:
        $title = "Tipo desconocido";
        break;
}
$type = $_GET["type"];

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "STATE", "type", "title", "error"))
    ->render();

?>