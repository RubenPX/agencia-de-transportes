<?php

namespace Crud;

use Clases\Destinatario;
use Clases\Envio as Envios;
use Clases\Remitente;

class Envio extends CRUDBase {
    public function get(string $id): array {
        $envio = new Envios();
        if ($id == "-1") {
            $found = $envio->recuperarEnvios();
            return $found[0];
        } else {
            $found = $envio->getEnvio($id);

            if (!$found) {
                throw new CRUDException("No se ha encontrado el envio con el id " . $id);
            }

            $found = $found;

            unset($found["tipo"]);

            $found["extra"] = [];

            $remitente = new Remitente();
            $found["extra"]["remitentes"] = $remitente->recuperarRemitentes();

            $destinatarios = new Destinatario();
            $found["extra"]["destinatarios"] = $destinatarios->recuperarDestinatarios();

            $found["extra"]["estados"] = $envio->getEstados();

            return $found;
        }
    }

    public function update(array $data): array {
        $envio = new Envios();
        // $envio->actualizarEnvio($data["from"], $data["idDestinatario"], $data["idRemitente"], )
        return ["!OK" => "Update recived"];
    }

    public function delete(string $id): array {
        $envio = new Envios();
        if (!$envio->borrarEnvio($id)) {
            return ["!ERROR" => "Fallo al eliminar el envio"];
        }
        return ["!OK" => "Delete recived"];
    }

    public function create(array $data): array {
        return ["!OK" => "Create recived"];
    }
}