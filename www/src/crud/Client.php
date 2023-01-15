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
        $cliente = new Cliente();
        // $cliente->actualizarCliente($data["from"], $data["nombre"], $data["apellidos"], $data["telefono"], $data["mail"], "", $data["activo"])
        return ["!OK" => "Update recived"];
    }

    public function delete(string $id): array {
        $cliente = new Cliente();

        $test = $cliente->borrarCliente($id);

        if (!$test) {
            return ["!ERROR" => "Error al borrar el cliente"];
        }

        return ["!OK" => "Eliminación completada"];
    }

    public function create(array $data): array {
        $cliente = new Cliente();

        $pass = hash("sha256", $data["password"]);

        if (!$cliente->crearCliente($data["DNI"], $data["nombre"], $data["apellidos"], $data["telefono"], $data["mail"], $pass, 0)) {
            return ["!ERROR" => "Fallo al crear el cliente, este ya existe"];
        }

        return ["!OK" => "Cliente creado"];
    }
}