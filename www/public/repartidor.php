<?php

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

echo $blade
    ->view()
    ->make('repartidor', compact("logedUser"))
    ->render();

?>