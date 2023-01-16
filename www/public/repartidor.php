<?php
use Clases\Poblacion;
use Clases\Repartidor;

require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

$repartidor = new Repartidor();
$properties = $repartidor->getRepartidor($loggedID);
$assocPueblo = $repartidor->getAssociatedPubelo($properties["id"]);

$pueblo = new Poblacion();
$properties["pueblo"] = !$assocPueblo ? "Ninguno" : $pueblo->getPoblacion($assocPueblo);

echo $blade
    ->view()
    ->make('panelRepartidor', compact("logedUser", "properties"))
    ->render();

?>