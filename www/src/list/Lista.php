<?php

namespace Lista;

// unitlity classes
use Clases\Converters;

// Database clases
use Clases\Cliente;
use Clases\Poblacion;
use Clases\Repartidor;
use Clases\Envio;

class Lista {
    public static function handle(string $type): array {
        switch ($type) {
            case 'Client':      return Lista::getClientes();
            case 'Pueblo':      return Lista::getPueblos();
            case 'Repartidor':  return Lista::getRepartidores();
            case 'Envio':       return Lista::getEnvios();
            default:            return ["!ERROR" => "Parameter type must be Clientes, Poblacion, Repartidores or Envios"];
        }
    }

    public static function getClientes(): array {
        $clientes = (new Cliente())->recuperarClientes();
        $found = Converters::objsToArray($clientes);

        $processArr = function ($n) {
            unset($n["password"]);

            $n["activo"] = $n["activo"] == 1 ? "Si" : "No";

            return $n;
        };

        return array_map($processArr, $found);
    }

    public static function getPueblos(): array {
        $poblacion = (new Poblacion())->recuperarPoblaciones();
        return Converters::objsToArray($poblacion);
    }

    public static function getRepartidores(): array {
        $repartidores = (new Repartidor())->recuperarRepartidores();
        $found = Converters::objsToArray($repartidores);

        $processArr = function ($n) {
            unset($n["password"]);
        };

        return array_map($processArr, $found);
    }

    public static function getEnvios(): array {
        $envios = (new Envio)->recuperarEnvios();
        return Converters::objsToArray($envios);
    }
}