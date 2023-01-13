<?php
require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// unitlity classes
use Clases\QueryParser;

// Database clases
use Clases\Cliente;
use Clases\Poblacion;
use Clases\Repartidor;
use Clases\Envio;

// Initialize variables
$error = "";
$title = "";
$properties = [];

// fail if there is no type parameter
if (!isset($_GET["type"])) {
    $error = "No se ha especificado el tipo de consulta";
}

$STATE = "EDIT";

// Load crud
require_once "./shared/crud.php";
$properties = crudHandler();

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "title", "STATE", "error"))
    ->render();

?>