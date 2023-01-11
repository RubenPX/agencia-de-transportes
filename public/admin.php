<?php

require_once "./shared/blade.php";

$logedUser = "Jhon Doe";

echo $blade
    ->view()
    ->make('ppalAdmin', compact("logedUser"))
    ->render();

?>