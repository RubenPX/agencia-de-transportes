<?php

require_once "./shared/blade.php";
require_once "./tmp/Controller.php";

$error = "";

if (!isset($_GET["type"])) {
    $error = "No se ha especificado el tipo de consulta";
}

$logedUser = "Jhon Doe";
$title = "";
$properties = [];

require_once "./tmp/crud.php";

// Examples
// Ver pueblo: http://localhost/crudView.php?type=Pueblo&ID=1
// Ver cliente: http://localhost/crudView.php?type=Client&Client=98765432A

if (isset($_GET["type"]) && $_GET["type"] == "Client") {
    $properties = getClient();
}

if (isset($_GET["type"]) && $_GET["type"] == "Pueblo") {
    $properties = getPoblacion();
}

/* Client access */
$readOnly = true;

echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "title", "readOnly", "error"))
    ->render();

?>