<?php

namespace Crud;

use Clases\Converters;
use Clases\Repartidor as Repartidores;

class Repartidor extends CRUDBase {
    public function get(string $id): array {
        $repartidor = new Repartidores();
        $found = $repartidor->getRepartidor($id);

        if (!$found) {
            throw new CRUDException("No se ha encontrado el repartidor con el id " . $id);
        }

        $found = Converters::objToArray($found);

        unset($found["password"]);

        return $found;
    }

    public function update(array $data): array {

    }

    public function delete(string $id): array {

    }

    public function create(array $data): array {

    }
}