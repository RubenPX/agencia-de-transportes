<?php

namespace Crud;

use Clases\Poblacion;
use Clases\Repartidor as Repartidores;

class Pueblo extends CRUDBase {
    public function get(string $id): array {
        $poblacion = new Poblacion();
        if ($id == "-1") {
            $found = $poblacion->getColumns();
            return $found;
        } else {
            $found = $poblacion->getPoblacion($id);

            if (!$found) {
                throw new CRUDException("No se ha encontrado el pueblo con el id " . $id);
            }

            $hasRepartidor = $poblacion->getAssociatedRepartidor($id);
            
            $found["idRepartidor"] = "";
            if (!!$hasRepartidor) {
                $found["idRepartidor"] = $hasRepartidor["idRepartidor"];
            }

            $repartidor = new Repartidores();
            $found["extra"] = [];
            $found["extra"]["repartidores"] = $repartidor->recuperarRepartidores();

            return $found;
        }
    }

    public function update(array $data): array {
        $poblacion = new Poblacion();
        
        if ($data["idRepartidor"] == "") {
            $poblacion->borrarRepartidorAsignado($data["from"]);
        } else {
            if (!$poblacion->asignarRepartidor($data["from"], $data["idRepartidor"])) {
                return ["!ERROR" => "Fallo al asignar el repartidor"];
            }
        }

        $poblacion->actualizarPoblacion($data["from"], $data["nombre"], $data["cp"]);

        return ["!OK" => "Información actualizada"];
    }

    public function delete(string $id): array {
        $poblacion = new Poblacion();
        if (!$poblacion->borrarPoblacion($id)) {
            return ["!ERROR" => "Fallo al borrar el pueblo"];
        }
        return ["!OK" => "Pueblo borrado"];

    }

    public function create(array $data): array {
        $poblacion = new Poblacion();
        if (!$poblacion->crearPoblacion($data["nombre"], intval($data["cp"]))) {
            return ["!ERROR" => "Fallo al crear el pueblo"];
        }
        return ["!OK" => "Pueblo creado"];
    }
}