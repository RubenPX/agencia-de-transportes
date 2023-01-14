<?php

namespace Crud;

use Clases\Converters;
use Clases\Cliente;

class Client extends CRUDBase {
    public function get(string $id): array {
        $cliente = new Cliente();

        if ($id == "-1") {
            $found = $cliente->recuperarClientes();
            $found = Converters::objToArray($found[0]);
        } else {
            $found = $cliente->getCliente($id);

            if (!$found) {
                throw new CRUDException("No se ha encontrado el cliente con el id " . $id);
            }
    
            $found = Converters::objToArray($found);
        }
        
        unset($found["password"]);
        $found["activo"] = $found["activo"] == 1 ? true : false;

        return $found;
    }

    public function update(array $data): array {

    }

    public function delete(string $id): array {

    }

    public function create(array $data): array {

    }
}