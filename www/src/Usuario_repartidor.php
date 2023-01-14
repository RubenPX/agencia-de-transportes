<?php

namespace Clases;

use PDOException;

class Usuario_repartidor extends Conexion {
    private $usuario;
    private $pass;

    public function __construct() {
        parent::__construct();
    }

    public function isValido($u, $p) {
        $pass1 = hash('sha256', $p);
        $consulta = "select * from repartidor where Nombre=:u AND password=:p"; /* OJO AQUI */
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':u' => $u,
                ':p' => $pass1
            ]);
        } catch (PDOException $ex) {
            die("Error al consultar usuario: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0)
            return false;
        return true;
    }
}