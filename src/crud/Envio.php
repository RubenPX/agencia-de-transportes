<?php

namespace Crud;

use Clases\Converters;
use Clases\Envio as Envios;

class Envio extends CRUDBase {
    public function get(string $id): array {
        $envio = new Envios();
        $found = $envio->getEnvio($id);

        if (!$found) {
            throw new CRUDException("No se ha encontrado el pueblo con el id " . $id);
        }

        return Converters::objToArray($found);
    }
    
	public function update(array $data): array {
        
	}
    
	public function delete(string $id): array {

	}
    
	public function create(array $data): array {

	}
}