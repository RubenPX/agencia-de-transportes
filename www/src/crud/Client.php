<?php

namespace Crud;

use Clases\Cliente;

class Client extends CRUDBase {
    public function get(string $id): array {
        $cliente = new Cliente();

        if ($id == "-1") {
            $found = $cliente->getColumns();
            unset($found["activo"]);
        } else {
            $found = $cliente->getCliente($id);

            if (!$found) {
                throw new CRUDException("No se ha encontrado el cliente con el id " . $id);
            }

            $found["activo"] = $found["activo"] == 1 ? true : false;
        }
        
        unset($found["password"]);
        return $found;
    }

    public function update(array $data): array {
        $cliente = new Cliente();

        $activo = $data["activo"] == "on" ? 1 : 0;
        $result = $cliente->actualizarCliente($data["from"], $data["DNI"], $data["nombre"], $data["apellidos"], $data["telefono"], $data["mail"], $activo);

        if (!$result) {
            return ["!ERROR" => "Fallo al actualizar el cliente"];
        }

        return ["!OK" => "Cliente actualizado"];
    }

    public function delete(string $id): array {
        $cliente = new Cliente();

        $found = $cliente->getCliente($id);

        if ($found["activo"] == "1") {
            return ["!ERROR" => "No se puede borrar un cliente activo"];
        }

        if (!$cliente->borrarCliente($id)) {
            return ["!ERROR" => "Error al borrar el cliente"];
        }

        return ["!OK" => "Eliminación completada"];
    }

    public function create(array $data): array {
        $cliente = new Cliente();

        $pass = hash("sha256", $data["password"]);
        $result = $cliente->crearCliente($data["DNI"], $data["nombre"], $data["apellidos"], $data["telefono"], $data["mail"], $pass, 0);

        if (!$result) {
            return ["!ERROR" => "Fallo al crear el cliente, este ya existe"];
        }

        return ["!OK" => "Cliente creado"];
    }
}