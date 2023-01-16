<?php

namespace Lista;

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

        $processArr = function ($n) {
            unset($n["password"]);

            $n["activo"] = $n["activo"] == 1 ? "Si" : "No";

            return $n;
        };

        return array_map($processArr, $clientes);
    }

    public static function getPueblos(): array {
        $poblacion = new Poblacion();
        $repartidores = new Repartidor();
        $found = $poblacion->recuperarPoblaciones();

        foreach ($found as $key => $value) {
            $foundRepartidor = $poblacion->getAssociatedRepartidor($value["id"]);

            if (!!$foundRepartidor) {
                $value["Repartidor"] = $repartidores->getRepartidor($foundRepartidor["idRepartidor"])["Nombre"];
            } else {
                $value["Repartidor"] = " ";
            }

            $found[$key] = $value;
        }

        return $found;
    }

    public static function getRepartidores(): array {
        $repartidores = new Repartidor();
        $pueblo = new Poblacion();
        $found = $repartidores->recuperarRepartidores();

        foreach ($found as $key => $value) {
            unset($value["password"]);

            $foundPueblo = $repartidores->getAssociatedPubelo($value["id"]);

            if (!!$foundPueblo) {
                $value["Pueblo"] = $pueblo->getPoblacion($foundPueblo["idPoblacion"])["nombre"];
            } else {
                $value["Pueblo"] = " ";
            }

            $found[$key] = $value;
        }

        return $found;
    }

    public static function getEnvios(): array {
        $envios = (new Envio)->recuperarEnvios();
        return $envios;
    }
}