<?php

namespace Crud;

abstract class CRUDBase {
    /**
     * Summary of handle
     * @param string $mode enum [ CREATE, DELETE, VIEW, EDIT ]
     * @param array $data Data to be processed
     * @return array
     */
    public function handle(string $mode, array $data): array {
        if (isset($data["GET_ID"])) { // if there has not any data it returns found data
            $mode = "VIEW";
        } elseif (count($data) == 0) {
            throw new CRUDException("No data specified");
        }

        switch ($mode) {
            case "VIEW":    return $this->get($data["GET_ID"]);
            case "UPDATE":  return $this->update($data);
            case "DELETE":  return $this->delete($data["DELETE_ID"]);
            case "CREATE":  return $this->create($data);
            default:        throw new CRUDException("Only can operate with VIEW, CREATE, UPDATE or DELETE");
        }
    }

    abstract public function get(string $id): array;
    abstract public function update(array $data): array;
    abstract public function delete(string $id): array;
    abstract public function create(array $data): array;
}