<?php
require_once "./shared/blade.php";
require_once "./shared/SessionLogin.php";

// unitlity classes
use Clases\Converters;

// Database clases
use Clases\Cliente;
use Clases\Poblacion;
use Clases\Repartidor;
use Clases\Envio;

$error = "";
$properties = [];

if (!isset($_GET["type"])) {
    $error = "Required parameter: type";
    echo $blade
        ->view()
        ->make('lista', compact("logedUser", "error"))
        ->render();
    die();
}

/* == Get clientes from DB == */
if($_GET["type"] == "Clientes") {
    $clientes = (new Cliente())->recuperarClientes();
    $properties = Converters::objsToArray($clientes);

    // Process items to show only what you want
    $processArrItem = function ($n) {
        unset($n["password"]);

        $n["activo"] = $n["activo"] == 1 ? "Si" : "No";

        return $n;
    };

    $properties = array_map($processArrItem, $properties);
} elseif($_GET["type"] == "Poblacion") {
    $poblacion = (new Poblacion())->recuperarPoblaciones();
    $properties = Converters::objsToArray($poblacion);
} elseif($_GET["type"] == "Repartidores") {
    $repartidores = (new Repartidor())->recuperarRepartidores();
    $properties = Converters::objsToArray($repartidores);
} elseif($_GET["type"] == "Envios") {
    $envios = (new Envio)->recuperarEnvios();
    $properties = Converters::objsToArray($envios);

    // todo: @RubenPX cambiar los ids y el estado a string en vez de numeros
} else {
    $error = "Parameter type must be Clientes, Poblacion, Repartidores or Envios";
    echo $blade
        ->view()
        ->make('lista', compact("logedUser", "error"))
        ->render();
    die();
}

$logedUser = "Jhon Doe";

echo $blade
    ->view()
    ->make('lista', compact("logedUser", "properties"))
    ->render();

?>