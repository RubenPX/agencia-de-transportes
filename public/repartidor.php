<?php

require_once "./shared/blade.php";

$logedUser = "Jhon Doe";

echo $blade
    ->view()
    ->make('repartidor', compact("logedUser"))
    ->render();

?>