<?php
require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// Initialize variables
$error = "";
$title = "";
$properties = [];

// fail if there is no type parameter
if (!isset($_GET["type"])) {
    $error = "No se ha especificado el tipo de consulta";
}

// Examples
// Ver pueblo: http://localhost/crudView.php?type=Pueblo&ID=1
// Ver cliente: http://localhost/crudView.php?type=Client&Client=98765432A

/* Set read only */
$STATE = "CREATE";

// Load crud
require_once "./shared/crud.php";
$properties = crudHandler();

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "title", "STATE", "error"))
    ->render();

?>