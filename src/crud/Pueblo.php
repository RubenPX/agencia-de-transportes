<?php

namespace Crud;

use Clases\Converters;
use Clases\Poblacion;

class Pueblo extends CRUDBase {
    public function get(string $id): array {
        $poblacion = new Poblacion();
        $found = $poblacion->getPoblacion($id);

        if (!$found) {
            throw new CRUDException("No se ha encontrado el pueblo con el id " . $id);
        }

        return Converters::objToArray($found);
    }

    public function update(array $data): array {

    }

    public function delete(string $id): array {
        return ["Result" => "Eliminado correctamente"];
    }

    public function create(array $data): array {

    }
}