<?php
use Crud\CRUD;

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// Initialize variables
$error = "";
$title = "Crear ";
$properties = [];

// Load state
$STATE = "CREATE";
$crud = new CRUD();

// todo: @bug This in future will be a bug (Fix in progress)
// todo: @bug This will fail if there has not values in table


if (isset($_POST["CREATE"])) {
    $properties = $crud->handle($_GET["type"], $STATE, $_POST);
} else {
    $properties = $crud->handle($_GET["type"], $STATE, ["GET_ID" => "-1"]);
}

// Detect if has error
if (isset($properties["!ERROR"])) {
    $error = $properties["!ERROR"];
}

// Detect if has success message
if (isset($properties["!OK"])) {
    $ok = $properties["!OK"];
}

// Set title
switch ($_GET["type"]) {
    case "Client":
        $title .= "cliente";
        $properties["password"] = "";
        break;
    case "Repartidor":
        $title .= "repartidor";
        $properties["password"] = "";
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
    if (gettype($i) == "array") {
        return $i;
    }
    if (gettype($i) == "boolean") {
        return false;
    }
    return "";
};
$properties = array_map($removeValues, $properties);

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "STATE", "type", "title", "error", "ok"))
    ->render();

?>