<?php
require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// Initialize variables
$error = "";
$title = "";
$properties = [];

// Examples
// Ver pueblo: http://localhost/crudView.php?type=Pueblo&ID=1
// Ver cliente: http://localhost/crudView.php?type=Client&Client=98765432A

/* Set read only */
$STATE = "READ";

// Load crud
require_once "./shared/crud.php";
$properties = crudHandler();

/* Render php blade file */
echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "title", "STATE", "error"))
    ->render();

?>