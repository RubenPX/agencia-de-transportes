<?php

namespace Crud;

use Clases\Cliente;
use Clases\Destinatario;
use Clases\Envio as Envios;
use Clases\Remitente;

class Envio extends CRUDBase {
    public function get(string $id): array {
        $envio = new Envios();
        if ($id == "-1") {
            $found = $envio->getColumns();
        } else {
            $found = $envio->getEnvio($id);

            if (!$found) {
                throw new CRUDException("No se ha encontrado el envio con el id " . $id);
            }
        }

        $found["extra"] = [];

        $remitente = new Remitente();
        $found["extra"]["remitentes"] = $remitente->recuperarRemitentes();

        $destinatarios = new Destinatario();
        $found["extra"]["destinatarios"] = $destinatarios->recuperarDestinatarios();

        $destinatarios = new Cliente();
        $found["extra"]["clientes"] = $destinatarios->recuperarClientes();

        $found["extra"]["estados"] = $envio->getEstados();

        return $found;
    }

    public function update(array $data): array {
        $envio = new Envios();
        $date = date_format(date_create($data["fecha"]), "Y-m-d");
        $runResult = $envio->actualizarEnvio($data["from"], $data["idDestinatario"], $data["idRemitente"], $data["DNICliente"], $date, $data["peso"], $data["ancho"], $data["largo"], $data["alto"], $data["estado"], $data["tarifa"]);
        if (!$runResult) {
            return ["!ERROR" => "Fallo al editar el envio"];
        }
        return ["!OK" => "Actualizado correctamente"];
    }

    public function delete(string $id): array {
        $envio = new Envios();
        if (!$envio->borrarEnvio($id)) {
            return ["!ERROR" => "Fallo al eliminar el envio"];
        }
        return ["!OK" => "Envio eliminado"];
    }

    public function create(array $data): array {
        $envio = new Envios();
        $date = date_format(date_create($data["fecha"]), "Y-m-d");
        $runResult = $envio->crearEnvio($data["idDestinatario"], $data["idRemitente"], $data["DNICliente"], $date, $data["peso"], $data["ancho"], $data["largo"], $data["alto"], $data["tarifa"]);
        if (!$runResult) {
            return ["!ERROR" => "Fallo al crear el envio"];
        }
        return ["!OK" => "Envio creado"];
    }
}