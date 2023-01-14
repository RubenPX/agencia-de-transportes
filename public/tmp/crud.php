<?php

function getClient() {
    global $error, $title;

    // Error if client para is not defined
    if (!isset($_GET["Client"])) {
        $error = "Client param required";
        return [];
    }

    // Start params
    $title = "Ver cliente";
    $dbc = new DatabaseController();
    $data = $dbc->runQuery("select * from cliente where DNI = '" . $_GET["Client"] . "'");

    // Error if client is not found
    if (count($data) == 0) {
        $error = "No se ha encontrado el cliente con el DNI " . $_GET["Client"];
        return [];
    }

    // Convert stdObject to Array
    $properties = json_decode(json_encode($data[0]), true);

    // Remove protected properties
    unset($properties["password"]);
    $properties["activo"] = $properties["activo"] == 1 ? true : false;

    // Return array
    return $properties;
}

function getPoblacion() {
    global $error, $title;

    // Error if client para is not defined
    if (!isset($_GET["ID"])) {
        $error = "Se requiere el parametro ID";
        return [];
    }

    // Start params
    $title = "Ver pueblo";
    $dbc = new DatabaseController();
    $data = $dbc->runQuery("select * from poblacion where id = '" . $_GET["ID"] . "'");

    // Error if client is not found
    if (count($data) == 0) {
        $error = "No se ha encontrado el pueblo con el id " . $_GET["ID"];
        return [];
    }

    // Convert stdObject to Array
    $properties = json_decode(json_encode($data[0]), true);

    // Return array
    return $properties;
}