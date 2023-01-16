<?php

namespace Crud;

use Clases\Poblacion;
use Clases\Repartidor as Repartidores;

class Repartidor extends CRUDBase {
    public function get(string $id): array {
        $repartidor = new Repartidores();

        if ($id == "-1") {
            $found = $repartidor->recuperarRepartidores();
            $found = $found[0];

            $found["extra"] = [];
            $found["extra"]["pueblos"] = (new Poblacion())->recuperarPoblaciones();
        } else {
            $found = $repartidor->getRepartidor($id);

            if (!$found) {
                throw new CRUDException("No se ha encontrado el repartidor con el id " . $id);
            }

            $hasAssociatedPueblo = $repartidor->getAssociatedPubelo($id);

            if (!!$hasAssociatedPueblo) {
                $found["idPoblacion"] = $hasAssociatedPueblo["idPoblacion"];
            }

            $found["extra"] = [];
            $found["extra"]["pueblos"] = (new Poblacion())->recuperarPoblaciones();
        }

        unset($found["password"]);

        return $found;
    }

    public function update(array $data): array {
        $repartidor = new Repartidores();

        if ($data["idPoblacion"] == "") {
            $repartidor->borrarPoblacionAsignada($data["from"]);
        } else {
            if (!$repartidor->asignarPoblacion($data["from"], $data["idPoblacion"])){
                return ["!ERROR" => "Fallo al asignar el pueblo"];
            }
        }

        $repartidor->actualizarRepartidor($data["from"], $data["DNI"], $data["Nombre"], $data["Apellidos"]);

        return ["!OK" => "Información de repartidor actualizada"];
    }

    public function delete(string $id): array {
        $repartidor = new Repartidores();
        if (!$repartidor->borrarRepartidor($id)) {
            return ["!ERROR" => "Fallo al borrar el repartidor"];
        }
        return ["!OK" => "Repartidor borrado"];
    }

    public function create(array $data): array {
        $repartidor = new Repartidores();

        $pass = hash("sha256", $data["password"]);

        if (!$repartidor->crearRepartidor($data["DNI"], $data["Nombre"], $data["Apellidos"], $pass)) {
            return ["!ERROR" => "Fallo al crear el repartidor"];
        }
        return ["!OK" => "Repartidor creado"];
    }
}