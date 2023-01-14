<?php
use Crud\CRUD;

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// Initialize variables
$error = "";
$title = "Ver ";
$properties = [];

// Load state
$STATE = "CREATE";
$crud = new CRUD();

// todo: This in future will be a bug (Fix in progress)
// todo: This will fail if there has not values in table
$properties = $crud->handle($_GET["type"], $STATE, ["GET_ID" => 1]);

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

// Elimina cualquier valor
$removeValues = function($i) {
    return "";
};
$properties = array_map($removeValues, $properties);

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "STATE", "type", "title", "error"))
    ->render();

?>