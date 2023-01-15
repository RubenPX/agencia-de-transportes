<?php

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

echo $blade
    ->view()
    ->make('panelRepartidor', compact("logedUser"))
    ->render();

?>