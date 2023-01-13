<?php

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// todo: @RubenPX complete template to use Classes//Envios

echo $blade
    ->view()
    ->make('envios', compact("logedUser"))
    ->render();

?>