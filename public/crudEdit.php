<?php

require_once "./shared/blade.php";

$logedUser = "Jhon Doe";
$title = "Editar cliente";
$properties = [
    "DNI" => "X1234567H",
    "nombre" => "Jhon",
    "apellidos" => "Doe",
    "telefono" => "645463518",
    "mail" => "jhondoe@example.com",
    "password" => "thisIsATestPassword",
    "activo" => true
];

unset($properties["password"]);
unset($properties["activo"]);

echo $blade
    ->view()
    ->make('crud', compact("logedUser", "properties", "title"))
    ->render();

?>