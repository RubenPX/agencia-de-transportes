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
$title = "Lista de ";

if (!isset($_GET["type"])) {
    $error = "Required parameter: type";
    echo $blade
        ->view()
        ->make('lista', compact("logedUser", "error"))
        ->render();
    die();
}

$type = $_GET["type"];

/* == Get clientes from DB == */
if ($type == "Client") {
    $title .= "clientes";
    $clientes = (new Cliente())->recuperarClientes();
    $properties = Converters::objsToArray($clientes);

    // Process items to show only what you want
    $processArrItem = function ($n) {
        unset($n["password"]);

        $n["activo"] = $n["activo"] == 1 ? "Si" : "No";

        return $n;
    };

    $properties = array_map($processArrItem, $properties);
} elseif ($type == "Pueblo") {
    $title .= "pueblos";
    $poblacion = (new Poblacion())->recuperarPoblaciones();
    $properties = Converters::objsToArray($poblacion);
} elseif ($type == "Repartidor") {
    $title .= "repartidores";
    $repartidores = (new Repartidor())->recuperarRepartidores();
    $properties = Converters::objsToArray($repartidores);
} elseif ($type == "Envio") {
    $title .= "envios";
    $envios = (new Envio)->recuperarEnvios();
    $properties = Converters::objsToArray($envios);
} else {
    $error = "Parameter type must be Clientes, Poblacion, Repartidores or Envios";
    $title = "Lista no encontrada";
    echo $blade
        ->view()
        ->make('lista', compact("logedUser", "error", "title"))
        ->render();
    die();
}

echo $blade
    ->view()
    ->make('lista', compact("logedUser", "properties", "title", "type"))
    ->render();

?>