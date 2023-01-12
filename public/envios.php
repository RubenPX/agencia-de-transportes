<?php

require_once "./shared/blade.php";

$logedUser = "Jhon Doe";

// todo: @RubenPX complete template to use Classes//Envios

echo $blade
    ->view()
    ->make('envios', compact("logedUser"))
    ->render();

?>