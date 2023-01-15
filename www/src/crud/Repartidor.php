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
    
            $found = $found;
        }

        unset($found["password"]);

        return $found;
    }

    public function update(array $data): array {
        return ["!OK" => "Update recived"];
    }

    public function delete(string $id): array {
        $repartidor = new Repartidores();
        if (!$repartidor->borrarRepartidor($id)) {
            return ["!ERROR" => "Fallo al borrar el repartidor"];
        }
        return ["!OK" => "Repartidor borrado"];
    }

    public function create(array $data): array {
        return ["!OK" => "Create recived"];
    }
}