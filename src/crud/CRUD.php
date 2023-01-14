<?php

namespace Crud;
use Error;

class CRUD {
    private CRUDBase $base;

    /**
     * Summary of handle
     * @param string $type enum [ Client, Repartidor, Pueblo, Envio ]
     * @param string $mode enum [ CREATE, DELETE, VIEW, EDIT ]
     * @param array $data Data to be processed (Set "GET_ID" property to get data) (Set "DELETE_ID" property to remove value from table)
     * @return array
     */
    public function handle(string $type, string $mode, array $data): array {
        try {

            switch ($type) {
                case "Client":      $this->base = new Client();        break;
                case "Repartidor":  $this->base = new Repartidor();    break;
                case "Pueblo":      $this->base = new Pueblo();        break;
                case "Envio":       $this->base = new Envio();         break;
                default:            throw new CRUDException("Required type: Client, Repartidor, Pueblo, Envio");
            }
    
            return $this->base->handle($mode, $data);

        } catch (CRUDException $err) {
            return ["!ERROR" => $err->getMessage()];
        }

    }
}